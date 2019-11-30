<?php

namespace Ocd\UserBundle\Model;

trait AntiLoginFloodTrait
{

    /**
     * Count consecutive Login Try on this account with a wrong password
     * Reseted on each successfull login
     * @var integer
     *
     * @ORM\Column(name="password_fails", type="integer", options={"default" : 0})
     */
    protected $passFails=0;

    /**
     * Last time a Login Failed
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_try_at", type="datetime", nullable=true)
     */
    protected $lastFailAt;

    /**
     * Last time a Login Succeded
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_login_at", type="datetime", nullable=true)
     */
    protected $lastLoginAt;

    /**
     * Last time a Session has been active
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_seen_at", type="datetime", nullable=true)
     */
    protected $lastSeenAt;

    /**
     * Last IP used to login
     * @var string|null
     *
     * @ORM\Column(name="last_ip", type="string", nullable=true)
     */
    protected $lastIP;

    /**
     * Last User Agent used to login
     * @var string|null
     *
     * @ORM\Column(name="last_ua", type="string", nullable=true)
     */
    protected $lastUA;
    

    /**
     * Get count consecutive Login Try on this account with a wrong password
     *
     * @return int
     */
    public function getPassFails(): int
    {
        return $this->passFails;
    }

    /**
     * Set count consecutive Login Try on this account with a wrong password
     *
     * @param int $passFails
     * 
     * @return self
     */
    public function setPassFails(int $passFails): self
    {
        $this->passFails = $passFails;

        return $this;
    }

    /**
     * New Login Fail for user
     *
     * @return self
     */
    public function newLoginFail(): self
    {
        $this->passFails++;
        $this->lastFailAt = new \DateTime();
        return $this;
    }

    /**
     * New Login Success for user
     *
     * @return self
     */
    public function newLoginSuccess(): self
    {
        $this->passFails=0;
        $this->lastLoginAt = new \DateTime();
        return $this;
    }

    /**
     * Get last time a Login Failed
     *
     * @return  \DateTime|null
     */
    public function getLastFailAt(): ?\DateTime
    {
        return $this->lastFailAt;
    }

    /**
     * Set last time a Login Failed
     *
     * @param  \DateTime  $lastFailAt
     * @return  self
     */
    public function setLastFailAt(\DateTime $lastFailAt): self
    {
        $this->lastFailAt = $lastFailAt;

        return $this;
    }

    /**
     * Get last time a Login Succeded
     *
     * @return  \DateTime|null
     */
    public function getLasLoginAt(): ?\DateTime
    {
        return $this->lastLoginAt;
    }

    /**
     * Set last time a Login Succeded
     *
     * @param  \DateTime  $lastLoginAt
     * @return  self
     */
    public function setLastLoginAt(\DateTime $lastLoginAt): self
    {
        $this->lastLoginAt = $lastLoginAt;

        return $this;
    }

    /**
     * Get last time a Session has been active
     *
     * @return  \DateTime|null
     */
    public function getLastSeenAt(): ?\DateTime
    {
        return $this->lastSeenAt;
    }

    /**
     * Set last time a Session has been active
     *
     * @param  \DateTime  $lastSeenAt
     * @return  self
     */
    public function setLastSeenAt(\DateTime $lastSeenAt): self
    {
        $this->lastSeenAt = $lastSeenAt;

        return $this;
    }

    /**
     * Get last IP used to login
     *
     * @return string|null
     */
    public function getLastIP(): ?string
    {
        return $this->lastIP;
    }

    /**
     * Set last IP used to login
     *
     * @param string $lastIP
     * @return self
     */
    public function setLastIP(string $lastIP): self
    {
        $this->lastIP = $lastIP;

        return $this;
    }

    /**
     * Get last User Agent used to login
     *
     * @return string|null
     */
    public function getLastUA(): ?string
    {
        return $this->lastUA;
    }

    /**
     * Set last User Agent used to login
     *
     * @param string $lastUA
     * @return self
     */
    public function setLastUA(string $lastUA): self
    {
        $this->lastUA = $lastUA;

        return $this;
    }




}
