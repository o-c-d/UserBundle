<?php

namespace Ocd\UserBundle\Model;


abstract class OcdUserAbstract implements OcdUserInterface
{
    /**
     * @var mixed
     */
    protected $id;
    /**
     * @var string
     */
    protected $username;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var bool
     */
    protected $enabled;
    /**
     * The salt to use for hashing.
     *
     * @var string
     */
    protected $salt;
    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
     */
    protected $password;
    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword;
    /**
     * @var \DateTime|null
     */
    protected $lastLogin;
    /**
     * Random string sent to the user email address in order to verify it.
     *
     * @var string|null
     */
    protected $confirmationToken;
    /**
     * @var \DateTime|null
     */
    protected $passwordRequestedAt;
    /**
     * @var array
     */
    protected $roles;
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->enabled = false;
        $this->roles = array();
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getUsername();
    }
    /**
     * {@inheritdoc}
     */
    public function addRole($role)
    {
        $role = strtoupper($role);
        if ($role === static::ROLE_DEFAULT) {
            return $this;
        }
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(array(
            $this->password,
            $this->salt,
            $this->username,
            $this->enabled,
            $this->id,
            $this->email,
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        list(
            $this->password,
            $this->salt,
            $this->username,
            $this->enabled,
            $this->id,
            $this->email,
        ) = $data;
    }
    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return $this->salt;
    }
    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * {@inheritdoc}
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    /**
     * Gets the last login time.
     *
     * @return \DateTime|null
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
    /**
     * {@inheritdoc}
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }
    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        $roles = $this->roles;
        foreach ($this->getGroups() as $group) {
            $roles = array_merge($roles, $group->getRoles());
        }
        // we need to make sure to have at least one role
        $roles[] = static::ROLE_DEFAULT;
        return array_values(array_unique($roles));
    }
    /**
     * {@inheritdoc}
     */
    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }
    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }
    public function isEnabled()
    {
        return $this->enabled;
    }
    /**
     * {@inheritdoc}
     */
    public function isSuperAdmin()
    {
        return $this->hasRole(static::ROLE_SUPER_ADMIN);
    }
    /**
     * {@inheritdoc}
     */
    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setEnabled($boolean)
    {
        $this->enabled = (bool) $boolean;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setSuperAdmin($boolean)
    {
        if (true === $boolean) {
            $this->addRole(static::ROLE_SUPER_ADMIN);
        } else {
            $this->removeRole(static::ROLE_SUPER_ADMIN);
        }
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setLastLogin(\DateTime $time = null)
    {
        $this->lastLogin = $time;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function setPasswordRequestedAt(\DateTime $date = null)
    {
        $this->passwordRequestedAt = $date;
        return $this;
    }
    /**
     * Gets the timestamp that the user requested a password reset.
     *
     * @return \DateTime|null
     */
    public function getPasswordRequestedAt()
    {
        return $this->passwordRequestedAt;
    }
    /**
     * {@inheritdoc}
     */
    public function isPasswordRequestNonExpired($ttl)
    {
        return $this->getPasswordRequestedAt() instanceof \DateTime &&
               $this->getPasswordRequestedAt()->getTimestamp() + $ttl > time();
    }
    /**
     * {@inheritdoc}
     */
    public function setRoles(array $roles)
    {
        $this->roles = array();
        foreach ($roles as $role) {
            $this->addRole($role);
        }
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getGroups()
    {
        return $this->groups ?: $this->groups = new ArrayCollection();
    }
    /**
     * {@inheritdoc}
     */
    public function getGroupNames()
    {
        $names = array();
        foreach ($this->getGroups() as $group) {
            $names[] = $group->getName();
        }
        return $names;
    }
    /**
     * {@inheritdoc}
     */
    public function hasGroup($name)
    {
        return in_array($name, $this->getGroupNames());
    }
    /**
     * {@inheritdoc}
     */
    public function addGroup(GroupInterface $group)
    {
        if (!$this->getGroups()->contains($group)) {
            $this->getGroups()->add($group);
        }
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function removeGroup(GroupInterface $group)
    {
        if ($this->getGroups()->contains($group)) {
            $this->getGroups()->removeElement($group);
        }
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function isEqualTo(BaseUserInterface $user)
    {
        if (!$user instanceof self) {
            return false;
        }
        if ($this->password !== $user->getPassword()) {
            return false;
        }
        if ($this->salt !== $user->getSalt()) {
            return false;
        }
        if ($this->username !== $user->getUsername()) {
            return false;
        }
        return true;
    }

}