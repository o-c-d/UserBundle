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
    private $username;

    /**
     * @ORM\Column(name="email", type="string", unique=true)
     * @Assert\NotBlank(message="user.email.not_blank")
     * @Assert\Email(message="user.email.not_valid")
     */
    private $email;

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
    private $password;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * @ORM\Column(name="salt", type="string", nullable=true)
     */
    private $salt;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = [];


    /**
     * Get the value of username
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
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
    }

    /**
     * Sets plain-text password.
     *
     * @param null|string $plainPassword
     *
     * @return $this
     */
    public function setPlainPassword(?string $plainPassword)
    {
    }

    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function addRole($role)
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
    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }
        return $this;
    }

    public function getSalt()
    {
    }
    public function setSalt($salt)
    {
    }

    public function eraseCredentials()
    {
    }
}
