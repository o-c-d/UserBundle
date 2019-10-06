<?php

namespace Ocd\UserBundle\Security;

use Ocd\UserBundle\Exception\AccountDeletedException;
use Ocd\UserBundle\Exception\AccountLockedException;
use Ocd\UserBundle\Exception\PasswordResetRequiredException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @see https://symfony.com/doc/current/security/user_checkers.html
 */
class OcdUserChecker implements UserCheckerInterface
{
    private $registry;

    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function checkPreAuth(UserInterface $user)
    {
        // user is deleted, show a generic Account Not Found message.
        if (is_null($user->getAccountDeletedAt()) || $user->getAccountDeletedAt() > new \DateTime()) {
            throw new AccountDeletedException();
        }
        // user account is locked, the user may be notified
        if (!$user->isAccountNonLocked()) {
            throw new AccountLockedException();
        }
        // user account is expired, the user may be notified
        if (!$user->isAccountNonExpired()) {
            throw new AccountExpiredException();
        }
        // password reset is required
        if ($user->isPasswordResetRequired()) {
            // generate then store a reset token in the user entity
            $token = bin2hex(random_bytes(32));
            $user->setResetToken($token);
            $this->registry->getManager()->persist($user);
            $this->registry->getManager()->flush();
            // store the reset token in the exception
            $exception = new PasswordResetRequiredException();
            $exception->setResetToken($token);
            throw $exception;
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
    }
}