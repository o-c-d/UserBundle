<?php

namespace Ocd\UserBundle\Event;

use Ocd\UserBundle\Model\SymfonyUserInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

class UserEvent extends Event
{
    /**
     * @var Request|null
     */
    protected $request;

    /**
     * @var SymfonyUserInterface
     */
    protected $user;

    /**
     * UserEvent constructor.
     *
     * @param SymfonyUserInterface $user
     * @param Request|null  $request
     */
    public function __construct(SymfonyUserInterface $user, Request $request = null)
    {
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * @return SymfonyUserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
