<?php

namespace Ocd\UserBundle\Exception;

use Symfony\Component\Security\Core\Exception\AccountStatusException;

class AccountLockedException extends AccountStatusException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'security.exception.login.account_locked';
    }
}