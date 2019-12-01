<?php

namespace Ocd\UserBundle\Event;

use Exception;
use Ocd\UserBundle\Model\SymfonyUserInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

class LoginFailedEvent extends Event
{
    /**
     * @var Exception|null
     */
    protected $exception;

    /**
     * LoginFailedEvent constructor.
     *
     * @param Exception $exception
     */
    public function __construct(Exception $exception = null)
    {
        $this->exception = $exception;
    }

    /**
     * @return Exception|null
     */
    public function getException()
    {
        return $this->exception;
    }
}
