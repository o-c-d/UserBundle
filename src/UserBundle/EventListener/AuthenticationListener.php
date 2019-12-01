<?php

namespace Ocd\UserBundle\EventListener;

use Ocd\UserBundle\Event\FilterUserResponseEvent;
use Ocd\UserBundle\Event\UserEvent;
use Ocd\UserBundle\Event\LoginFailedEvent;
use Ocd\UserBundle\Event\OcdUserEvents;
use Ocd\UserBundle\Security\OcdLoginManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;

class AuthenticationListener implements EventSubscriberInterface
{
    /**
     * @var OcdLoginManagerInterface
     */
    private $loginManager;

    /**
     * @var string
     */
    private $firewallName;

    /**
     * AuthenticationListener constructor.
     *
     * @param OcdLoginManagerInterface $loginManager
     * @param string                $firewallName
     */
    public function __construct(OcdLoginManagerInterface $loginManager, $firewallName)
    {
        $this->loginManager = $loginManager;
        $this->firewallName = $firewallName;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            OcdUserEvents::REGISTRATION_COMPLETED => 'authenticate',
            OcdUserEvents::REGISTRATION_CONFIRMED => 'authenticate',
            OcdUserEvents::RESETTING_PASSWORD_COMPLETED => 'authenticate',
        );
    }

    /**
     * @param FilterUserResponseEvent  $event
     * @param string                   $eventName
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function authenticate(FilterUserResponseEvent $event, $eventName, EventDispatcherInterface $eventDispatcher)
    {
        try {
            $this->loginManager->logInUser($this->firewallName, $event->getUser(), $event->getResponse());

            $eventDispatcher->dispatch(OcdUserEvents::SECURITY_IMPLICIT_LOGIN, new UserEvent($event->getUser(), $event->getRequest()));
        } catch (AccountStatusException $ex) {
            // We simply do not authenticate users which do not pass the user
            // checker (not enabled, expired, etc.).
            $eventDispatcher->dispatch(OcdUserEvents::SECURITY_FAILED_LOGIN, new LoginFailedEvent($ex->getStatusCode(), $ex->getMessage()));
        }
    }
}
