<?php

namespace Ocd\UserBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CurrentUserProvider
{
    private $user;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        if(null !== $tokenStorage->getToken())
        {
            $this->user = $tokenStorage->getToken()->getUser();
        }
        
    }

    public function getUser()
    {
        return $this->user;
    }
}