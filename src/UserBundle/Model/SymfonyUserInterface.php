<?php

namespace Ocd\UserBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface SymfonyUserInterface extends UserInterface
{
    const DEFAULT_ROLE = 'ROLE_USER';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_USER_ADMIN = 'ROLE_USER_ADMIN';
    public function getUsername();
    public function setUsername(); 
    public function getPassword();
    public function setPassword();

    /**
     * Returns plain-text password.
     *
     * @return null|string
     */
    public function getPlainPassword(): ?string;
    /**
     * Sets plain-text password.
     *
     * @param null|string $plainPassword
     *
     * @return $this
     */
    public function setPlainPassword(?string $plainPassword);
    public function getEmail();
    public function setEmail();
    public function getRoles();
    public function setRoles();
    public function addRole();
    public function removeRole();
    public function getSalt();
    public function setSalt();
    public function eraseCredentials();

}

