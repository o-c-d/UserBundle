<?php

namespace Ocd\UserBundle\Exception;

use Symfony\Component\Security\Core\Exception\AccountStatusException;

class AccountDeletedException extends AccountStatusException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'security.exception.login.account_deleted';
    }
}