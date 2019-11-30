<?php

namespace Ocd\UserBundle\Security;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Registry ;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class OcdUserProvider implements UserProviderInterface
{
    private $userClass;
    private $registry;
    private $encoder;
    
    public function __construct($userClass, Registry $registry, EncoderFactoryInterface $encoder)
    {
        $this->userClass = $userClass;
        $this->registry = $registry;
        $this->encoder = $encoder;
    }
    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        return $this->findUserByUsername($username);
    }
    public function findUserByUsername(string $username): UserInterface
    {
        $user = $this->registry->getRepository($this->userClass)->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
        if (null === $user) {
            throw new UsernameNotFoundException();
        }
        return $user;
    }
    public function findUserByResetToken(string $token): UserInterface
    {
        $user = $this->registry->getRepository($this->userClass)->createQueryBuilder('u')
            ->where('u.reset_token = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
        if (null === $user) {
            throw new UsernameNotFoundException();
        }
        return $user;
    }
    public function getEncoder(UserInterface $user): PasswordEncoderInterface
    {
        return $this->encoder->getEncoder($user);
    }
    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByUsername($user->getUsername());
    }
    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return \in_array(UserInterface::class, class_implements($class), true);
    }
}