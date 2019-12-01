<?php

namespace Ocd\UserBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface SymfonyUserInterface extends UserInterface
{
    const DEFAULT_ROLE = 'ROLE_USER';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_USER_ADMIN = 'ROLE_USER_ADMIN';
    public function getUsername() :string;
    public function setUsername(string $username); 
    public function getPassword() :string;
    public function setPassword(string $password);
    public function getPlainPassword(): ?string;
    public function setPlainPassword(?string $plainPassword);
    public function getEmail() :string;
    public function setEmail(string $email);
    public function getRoles() :array;
    public function setRoles(array $roles);
    public function addRole(string $role);
    public function removeRole(string $role);
    public function getSalt() :?string;
    public function setSalt(?string $salt);
    public function eraseCredentials();

}

