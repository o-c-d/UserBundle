<?php

namespace Ocd\UserBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait SymfonyUserTrait
{
    /**
     * @ORM\Column(name="username", type="string", unique=true)
     * @Assert\NotBlank(message="user.username.not_blank")
     */
    protected $username;

    /**
     * @ORM\Column(name="email", type="string", unique=true)
     * @Assert\NotBlank(message="user.email.not_blank")
     * @Assert\Email(message="user.email.not_valid")
     */
    protected $email;

    /**
     * @ORM\Column(name="password", type="string", length=64)
     * @Assert\NotBlank(message="user.password.not_blank")
     * @Assert\Length(
     *      min = 12,
     *      max = 250,
     *      minMessage = "user.password.min_length {{ limit }}",
     *      maxMessage = "user.password.max_length {{ limit }}"
     * )
     * @Assert\NotCompromisedPassword(
     *      message="user.password.compromised_password",
     *      skipOnError=true
     * )
     */
    protected $password;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * @ORM\Column(name="salt", type="string", nullable=true)
     */
    protected $salt;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    protected $roles = [];


    /**
     * Get the value of username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername(string $username) :self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(string $password) :self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returns plain-text password.
     *
     * @return null|string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword ;
    }

    /**
     * Sets plain-text password.
     *
     * @param null|string $plainPassword
     *
     * @return $this
     */
    public function setPlainPassword(?string $plainPassword) :self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(string $email) :self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of roles
     */
    public function getRoles() :array
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */
    public function setRoles(array $roles=[]) :self
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function addRole(string $role) :self
    {
        $role = strtoupper($role);
        if (!in_array(strtoupper($role), $this->getRoles(), true)) {
            $this->roles[] = $role;
        }
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function removeRole(string $role) :self
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }
        return $this;
    }

    public function getSalt() :?string
    {
        return $this->salt;
    }
    public function setSalt(?string $salt) :self
    {
        $this->salt = $salt;
        return $this;
    }

    public function eraseCredentials() :self
    {
        $this->plainPassword = null;
        return $this;
    }
}
