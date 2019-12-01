<?php

namespace Ocd\UserBundle\Exception;

use Symfony\Component\Security\Core\Exception\AccountStatusException;

class PasswordResetRequiredException extends AccountStatusException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'security.exception.login.password_reset_required';
    }
}