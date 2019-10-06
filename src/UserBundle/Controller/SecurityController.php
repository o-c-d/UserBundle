<?php

namespace Ocd\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Core\Security;

class SecurityController extends AbstractController
{
    private $tokenManager;
    public function __construct(CsrfTokenManagerInterface $tokenManager = null)
    {
        $this->tokenManager = $tokenManager;
    }

    /**
     */
    public function login(Request $request)
    {
        $session = $request->getSession();
        $lastUsernameKey = Security::LAST_USERNAME;
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);
        
        $authErrorKey = Security::AUTHENTICATION_ERROR;
        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }
        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }
        
        $csrfToken = $this->tokenManager ? $this->tokenManager->getToken('authenticate')->getValue() : null;
        
        return $this->render('@OcdUser/security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ]);
    }

    /**
     * This is the route the user can use to logout.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in config/packages/security.yaml
     *
     */
    public function logout(): void
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

    /**
     * @Route("/forgot_password", name="security_forgot_password")
     */
    public function forgotPasswordRequest(Request $request)
    {
        $sent_mail = false ;
        $forgot_email = '' ;
		$translator = $this->get('translator') ;
		$user_manager = $this->get('ocd.user.user_manager') ;
		$password_reset_manager = $this->get('ocd.user.password_reset_manager') ;
		$tokenGenerator = $this->get('ocd.user.token_generator') ;
		$config = $this->container->getParameter('ocd_user.config');
        $form = '' ;
        $errors = [] ;
		$em = $this->getDoctrine()->getManager();
		$forgotPasswordModel = new ForgotPassword();
					$now = new \DateTime('now') ;
					$validity = $now->modify($config['password_reset']['password_reset_validity']) ;
		
		$form = $this->createForm( ForgotPasswordType::class, $forgotPasswordModel);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()) {
			$forgot_email = $form->get('email')->getData();
			// check if mail exists for some user
			// $check_mail_user = $em->getRepository('OcdUserBundle:OcdUser')->findBy(array('email' => $forgot_email));
			$check_mail_user = $user_manager->findUserByEmail($forgot_email) ;
			if($check_mail_user) {
				// forgot_email belongs to a user
				
				// check if a reset request is still valid for this mail
				// $check_mail_reset = $em->getRepository('OcdUserBundle:OcdUserPasswordReset')->findValidRequestByEmail($forgot_email) ;
				$check_mail_reset = $password_reset_manager->findPasswordResetByEmail($forgot_email) ;
				if($check_mail_reset) {
					// a reset request is still valid
					$errors[] = $translator->trans('message.error.forgot_password.valid_request_exists', array('%validity%'=>$validity->format('d/m/Y')), 'OcdUserBundle') ;
					// $request->getSession()->getFlashBag()->add('error', $translator->trans('message.error.forgot_password.valid_request_exists', array('%validity%'=>$validity->format('d/m/Y')), 'OcdUserBundle')) ;
				} else {
					// we can send a request for password reset
					// generate Token
					// $tokenGenerator = $this->get('ocd.user.token_generator') ;
					$token = $tokenGenerator->generateToken() ;
					$ip_request = $request->getClientIp() ;
					// $status = 'mail_sent' ;
					
				
				$new_password_reset = $password_reset_manager->createPasswordReset() ;
				$new_password_reset->setEmail($forgot_email) ;
				$new_password_reset->setToken($token) ;
				$new_password_reset->setIpRequest($ip_request) ;
				$password_reset_manager->updatePasswordReset($new_password_reset) ;
					
					// send mail
                $message = \Swift_Message::newInstance()
					->setSubject($translator->trans('message.email.forgot_password.subject', array('%website%'=>$website), 'OcdUserBundle'))
					->setFrom($config['email_sender']['sender_address'])
					->setTo($forgot_email)
					->setBody(
						$this->renderView(
							// app/Resources/views/Emails/registration.html.twig
							'OcdUserBundle:emails:forgot_password.html.twig',
							array(
								'website' => $config['email_sender']['sender_website'],
								'username' => $forgot_email,
								'token' => $token,
								'validity' => $validity,
							)
						),
						'text/html'
					) ;
					$this->get('mailer')->send($message);
					$sent_mail = true ;
					
				}
				
			} else {
				// forgot_email is not in OcdUser
					// forgot_email is unknown
					$errors[] = $translator->trans('message.error.forgot_password.unknown_email', array(), 'OcdUserBundle') ;
					// $request->getSession()->getFlashBag()->add('error', $translator->trans('message.error.forgot_password.unknown_email', array(), 'OcdUserBundle')) ;
			}
			
		}
		
		return $this->render('OcdUserBundle:security:forgot_password.html.twig', array(
            // forgot_email form
            'form' => $form->createView(),
            // email sent
            'sent_mail' => $sent_mail,
            // email address
            'forgot_email' => $forgot_email,
            'errors' => $errors,
            'config' => $config,
        ));
    }

    /**
     * @Route("/forgot_password/{token}", name="security_forgot_password_token")
     */
    public function forgotPasswordReset(Request $request, $token)
    {
		$translator = $this->get('translator') ;
		$config = $this->container->getParameter('ocd_user.config');
		$password_min_length = $config['security']['password_min_length'] ;
		$user_manager = $this->get('ocd.user.user_manager') ;
		$password_reset_manager = $this->get('ocd.user.password_reset_manager') ;
		$encoder = $this->container->get('security.password_encoder');
		$current_time = new \DateTime() ;
		$messages = [] ;
		$form = false ;
		$password_request = false ;
		// user login
		//change password form
		$em = $this->getDoctrine()->getManager();
		// $password_request = $em->getRepository('OcdUserBundle:OcdUserPasswordReset')->findValidRequestByToken($token);
				$password_request = $password_reset_manager->findPasswordResetByToken($token) ;
		if($password_request) {
			// form new password
			$newPasswordModel = new NewPassword();
			$formNewP = $this->createForm( NewPasswordType::class, $newPasswordModel);
			$form = $formNewP->createView() ;
			$formNewP->handleRequest($request);
			if($formNewP->isSubmitted() && $formNewP->isValid()) {
				// load user from token
				$forgot_email = $password_request->getEmail() ;
				// $user_request = $em->getRepository('OcdUserBundle:OcdUser')->loadUserByUsername($forgot_email) ;
				$user_request = $user_manager->findUserByEmail($forgot_email) ;
				// save new paswword
				$plainNewPassword = $formNewP->get('newPassword')->getData();
				if(strlen($plainNewPassword)>=$password_min_length) {
					$new_password_encoded = $encoder->encodePassword($user_request, $plainNewPassword);
					$user_request->setPassword($new_password_encoded);
					$user_request->setPasswordExpiresAt($current_time->modify($config['security']['password_expiration_period'])) ;
					// $em->persist($user_request);
					// $em->flush();
					$user_manager->updateUser($user_request) ;
					//update request
					$password_request->setValid(BasePasswordReset::VALID_DISABLED) ;
					// $em->persist($password_request);
					// $em->flush();
					$password_reset_manager->updatePasswordReset($password_request) ;
					// disable form to inform new password is saved
					$form = false ;
					
				
				} else {
					$messages[] = $translator->trans('message.error.forgot_password.invalid_password', array('%password_min_length%'=>$password_min_length), 'OcdUserBundle') ;
				}
			} elseif($formNewP->isSubmitted()) {
				$messages[] = $translator->trans('message.error.forgot_password.invalid_password', array('%password_min_length%'=>$password_min_length), 'OcdUserBundle') ;
			}
		} else {
			// token is not valid
			$messages[] = $translator->trans('message.error.forgot_password.invalid_token', array(), 'OcdUserBundle') ;
			// $request->getSession()->getFlashBag()->add('error', $translator->trans('message.error.forgot_password.invalid_token', array(), 'OcdUserBundle')) ;
		}
		
		
        return $this->render('OcdUserBundle:security:forgot_password_token.html.twig', array(
            'password_request' => $password_request,
            'form' => $form,
            'messages' => $messages,
        ));
    }

    /**
     */
    public function profile(Request $request)
    {
        return $this->render('@OcdUser/security/profile.html.twig', [
            'user' => $user,
        ]);
    }
}