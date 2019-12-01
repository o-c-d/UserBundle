<?php

namespace Ocd\UserBundle\EventListener;

use Ocd\UserBundle\Event\UserEvent;
use Ocd\UserBundle\Event\OcdUserEvents;
use Ocd\UserBundle\Model\SymfonyUserInterface;
use Ocd\UserBundle\Model\Manager\OcdUserManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class LastLoginListener implements EventSubscriberInterface
{
    protected $userManager;

    /**
     * LastLoginListener constructor.
     *
     * @param OcdUserManagerInterface $userManager
     */
    public function __construct(OcdUserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            OcdUserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
        );
    }

    /**
     * @param UserEvent $event
     */
    public function onImplicitLogin(UserEvent $event)
    {
        $user = $event->getUser();

        $user->setLastLoginAt(new \DateTime());
        $this->userManager->updateUser($user);
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        if ($user instanceof SymfonyUserInterface) {
            $user->setLastLoginAt(new \DateTime());
            $this->userManager->updateUser($user);
        }
    }
}
