<?php

namespace Ocd\UserBundle\EventListener;

use \DateTime;
use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Ocd\UserBundle\Model\BlameableInterface;
use Ocd\UserBundle\Model\TimestampableInterface;
use Ocd\UserBundle\Security\CurrentUserProvider;


class DoctrineListener implements EventSubscriber
{
    protected $userProvider;

    /**
     * DoctrineListener constructor.
     *
     * @param CurrentUserProvider $userProvider
     */
    public function __construct(CurrentUserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function getSubscribedEvents()
    {
        return array('prePersist', 'preUpdate');
    }

    public function prePersist(EventArgs $args)
    {
        $entity = $args->getObject();
        // $entityManager = $args->getObjectManager();
        if ($entity instanceof BlameableInterface) {
            $entity->setCreatedBy($this->userProvider->getUser());
        }
        if ($entity instanceof TimestampableInterface) {
            $entity->setCreatedAt(new DateTime());
            $entity->setUpdatedAt(new DateTime());
        }
    }

    public function preUpdate(EventArgs $args)
    {
        $entity = $args->getObject();
        // $entityManager = $args->getObjectManager();
        if ($entity instanceof BlameableInterface) {
            $entity->setUpdatedBy($this->userProvider->getUser());
        }
        if ($entity instanceof TimestampableInterface) {
            $entity->setUpdatedAt(new DateTime());
        }
    }
}
