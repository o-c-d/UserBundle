<?php

namespace Ocd\UserBundle\Event;

use Ocd\UserBundle\Model\SymfonyUserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilterUserResponseEvent extends UserEvent
{
    private $response;

    /**
     * FilterUserResponseEvent constructor.
     *
     * @param SymfonyUserInterface $user
     * @param Request       $request
     * @param Response      $response
     */
    public function __construct(SymfonyUserInterface $user, Request $request, Response $response)
    {
        parent::__construct($user, $request);
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets a new response object.
     *
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
}
