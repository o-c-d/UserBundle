<?php

namespace Ocd\UserBundle\Model;

interface OcdGroupInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name);

    /**
     * @param string $role
     *
     * @return static
     */
    public function addRole($role);

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role);

    /**
     * @return array
     */
    public function getRoles();

    /**
     * @param string $role
     *
     * @return static
     */
    public function removeRole($role);
    
    /**
     * @param array $roles
     *
     * @return static
     */
    public function setRoles(array $roles);
}