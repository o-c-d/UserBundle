<?php

namespace Ocd\UserBundle\Security;

use Ocd\UserBundle\Model\SymfonyUserInterface;
use Symfony\Component\HttpFoundation\Response;

interface OcdLoginManagerInterface
{
    /**
     * @param string        $firewallName
     * @param SymfonyUserInterface $user
     * @param Response|null $response
     */
    public function logInUser($firewallName, SymfonyUserInterface $user, Response $response = null);
}
