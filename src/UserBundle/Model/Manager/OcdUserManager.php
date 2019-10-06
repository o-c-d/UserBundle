<?php


namespace Ocd\UserBundle\Model\Manager;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;


class OcdUserManager
{
    /**
     * @var PasswordEncoderInterface
     */
    private $encoderFactory;

    public function __construct($userClass, RegistryInterface $registry, EncoderFactoryInterface $encoderFactory)
    {
        $this->userClass = $userClass;
        $this->registry = $registry;
        $this->encoderFactory = $encoderFactory;
    }

    public function listUser($filter, $order, $limit)
    {
        return $this->registry->getRepository($this->userClass)->findBy($filter, $order, $limit);
    }

    public function createUser($data)
    {
        $userClass = $this->userClass ;
        $user = new $userClass();
        if(isset($data['username'])) $user->setUsername($data['username']);
        if(isset($data['password'])) $user->setPassword($data['password']);
        if(isset($data['email'])) $user->setEmail($data['email']);
        if(isset($data['roles'])) $user->setRoles($data['roles']);
        $this->registry->getManager()->persist($user);
        $this->registry->getManager()->flush();
    }

    public function hashPassword(UserInterface $user)
    {
        $plainPassword = $user->getPlainPassword();
        if (0 !== strlen($plainPassword)) {
            $salt = null;
            if (!($this->encoderFactory->getEncoder($user) instanceof BCryptPasswordEncoder)) {
                // salt is not used by bcrypt encoder
                $salt = rtrim(str_replace('+', '.', base64_encode(random_bytes(32))), '=');
            }
            $user->setSalt($salt);
            $hashedPassword = $this->encoderFactory->getEncoder($user)->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($hashedPassword);
            $user->eraseCredentials();
        }
    }

}