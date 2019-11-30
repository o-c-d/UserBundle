<?php

namespace Ocd\UserBundle\Model;

use Doctrine\ORM\Mapping as ORM;

trait AdvancedUserTrait
{

    /**
     * DateTime of Password Expiration
     * => Login is not allowed after this date
     * => Is nullified on Password update
     * @var \DateTime|null
     * 
     * @ORM\Column(name="password_expired_at", type="datetime", nullable=true, options={"default": NULL})
     */
    protected $passwordExpiredAt;

    /**
     * DateTime of Account Deletion
     * => Login is not allowed after this date
     * @var \DateTime|null
     * 
     * @ORM\Column(name="account_deleted_at", type="datetime", nullable=true, options={"default": NULL})
     */
    protected $accountDeletedAt;
 
    /**
     * DateTime of Account Expiration
     * => Login is not allowed after this date
     * @var \DateTime|null
     * 
     * @ORM\Column(name="account_expired_at", type="datetime", nullable=true, options={"default": NULL})
     */
    protected $accountExpiredAt;

    /**
     * DateTime of Account Lock
     * => Login is not allowed after this date
     * @var \DateTime|null
     *
     * @ORM\Column(name="account_locked_at", type="datetime", nullable=true, options={"default": NULL})
     */
    protected $accountLockedAt;

    /**
     * Account is Enabled
     * @var bool
     * 
     * @ORM\Column(name="account_is_enabled", type="boolean", options={"default": "0"})
     */
    protected $accountIsEnabled;

    /**
     * Get dateTime of Password Expiration
     */ 
    public function getPasswordExpiredAt()
    {
        return $this->passwordExpiredAt;
    }

    /**
     * Set dateTime of Password Expiration
     *
     * @return  self
     */ 
    public function setPasswordExpiredAt($passwordExpiredAt)
    {
        $this->passwordExpiredAt = $passwordExpiredAt;

        return $this;
    }

    /**
     * Get dateTime of Account Deletion
     */ 
    public function getAccountDeletedAt()
    {
        return $this->accountDeletedAt;
    }

    /**
     * Set dateTime of Account Deletion
     *
     * @return  self
     */ 
    public function setAccountDeletedAt($accountDeletedAt)
    {
        $this->accountDeletedAt = $accountDeletedAt;

        return $this;
    }

    /**
     * Get dateTime of Account Expiration
     */ 
    public function getAccountExpiredAt()
    {
        return $this->accountExpiredAt;
    }

    /**
     * Set dateTime of Account Expiration
     *
     * @return  self
     */ 
    public function setAccountExpiredAt($accountExpiredAt)
    {
        $this->accountExpiredAt = $accountExpiredAt;

        return $this;
    }

    /**
     * Get dateTime of Account Lock
     */ 
    public function getAccountLockedAt()
    {
        return $this->accountLockedAt;
    }

    /**
     * Set dateTime of Account Lock
     *
     * @return  self
     */ 
    public function setAccountLockedAt($accountLockedAt)
    {
        $this->accountLockedAt = $accountLockedAt;

        return $this;
    }

    /**
     * Get account is Enabled
     */ 
    public function getAccountIsEnabled()
    {
        return $this->accountIsEnabled;
    }

    /**
     * Set account is Enabled
     *
     * @return  self
     */ 
    public function setAccountIsEnabled($accountIsEnabled)
    {
        $this->accountIsEnabled = $accountIsEnabled;

        return $this;
    }







    /** AdvancedUserInterface */
    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return ( is_null($this->account_expired_at) || $this->account_expired_at > new \DateTime() ) ;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return ( is_null($this->account_locked_at) || $this->account_locked_at > new \DateTime() ) ;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return ( is_null($this->password_expired_at) || $this->password_expired_at > new \DateTime() ) ;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->getAccountIsEnabled();
    }




}