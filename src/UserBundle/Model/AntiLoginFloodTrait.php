<?php

namespace Ocd\UserBundle\Model;


trait AntiLoginFloodTrait
{

    /**
     * Count consecutive Login Try on this account with a wrong password
     * Reseted on each successfull login
     * @ORM\Column(name="password_fails", type="integer", options={"default" : 0})
     */
    protected $passFails=0;

    /**
     * Last time a Login Failed
     * @var \DateTime
     *
     * @ORM\Column(name="last_try", type="datetime", nullable=true)
     */
    protected $lastTry;

    /**
     * Last time a Login Succeded
     * @var \DateTime
     *
     * @ORM\Column(name="last_seen", type="datetime", nullable=true)
     */
    protected $lastSeen;

    /**
     * Last IP used to login
     * @ORM\Column(name="last_ip", type="string", nullable=true)
     */
    protected $lastIP;

    /**
     * Last User Agent used to login
     * @ORM\Column(name="last_ua", type="string", nullable=true)
     */
    protected $lastUA;
    

    /**
     * Get count consecutive Login Try on this account with a wrong password
     */ 
    public function getPassFails()
    {
        return $this->passFails;
    }

    /**
     * Set count consecutive Login Try on this account with a wrong password
     *
     * @return  self
     */ 
    public function setPassFails($passFails)
    {
        $this->passFails = $passFails;

        return $this;
    }

    /**
     * Get last time a Login Failed
     *
     * @return  \DateTime
     */ 
    public function getLastTry()
    {
        return $this->lastTry;
    }

    /**
     * Set last time a Login Failed
     *
     * @param  \DateTime  $lastTry  Last time a Login Failed
     *
     * @return  self
     */ 
    public function setLastTry(\DateTime $lastTry)
    {
        $this->lastTry = $lastTry;

        return $this;
    }

    /**
     * Get last time a Login Succeded
     *
     * @return  \DateTime
     */ 
    public function getLastSeen()
    {
        return $this->lastSeen;
    }

    /**
     * Set last time a Login Succeded
     *
     * @param  \DateTime  $lastSeen  Last time a Login Succeded
     *
     * @return  self
     */ 
    public function setLastSeen(\DateTime $lastSeen)
    {
        $this->lastSeen = $lastSeen;

        return $this;
    }

    /**
     * Get last IP used to login
     */ 
    public function getLastIP()
    {
        return $this->lastIP;
    }

    /**
     * Set last IP used to login
     *
     * @return  self
     */ 
    public function setLastIP($lastIP)
    {
        $this->lastIP = $lastIP;

        return $this;
    }

    /**
     * Get last User Agent used to login
     */ 
    public function getLastUA()
    {
        return $this->lastUA;
    }

    /**
     * Set last User Agent used to login
     *
     * @return  self
     */ 
    public function setLastUA($lastUA)
    {
        $this->lastUA = $lastUA;

        return $this;
    }
}