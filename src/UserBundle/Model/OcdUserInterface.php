<?php


namespace Ocd\UserBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface OcdUserInterface extends UserInterface
{
    /**
     * Returns the roles granted to the user.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles();
    /**
     * Returns the password used to authenticate the user.
     *
     * @return string The password
     */
    public function getPassword();
    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt();
    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername();
    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials();

}