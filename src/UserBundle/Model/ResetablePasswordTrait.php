<?php 

namespace Ocd\UserBundle\Model;

use \DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait ResetablePasswordTrait
{

    /**
     * DateTime of Password Reset Request 
     * 
     * @ORM\Column(name="password_reset_requested_at", type="datetime", nullable=true, options={"default": NULL})
     */
    protected $passwordResetRequestedAt;

    /**
     * Password Reset Token
     * 
     * @ORM\Column(name="password_reset_token", type="string", length=255, nullable=true, options={"default": NULL})
     */
    protected $passwordResetToken;

    /**
     * Get dateTime of Password Reset Request
     */ 
    public function getPasswordResetRequestedAt() :DateTimeInterface
    {
        return $this->passwordResetRequestedAt;
    }

    /**
     * Set dateTime of Password Reset Request
     *
     * @return  self
     */ 
    public function setPasswordResetRequestedAt(DateTimeInterface $passwordResetRequestedAt)
    {
        $this->passwordResetRequestedAt = $passwordResetRequestedAt;

        return $this;
    }

    /**
     * Get password Reset Token
     */ 
    public function getPasswordResetToken() :?string
    {
        return $this->passwordResetToken;
    }

    /**
     * Set password Reset Token
     *
     * @return  self
     */ 
    public function setPasswordResetToken(?string $passwordResetToken) :self
    {
        $this->passwordResetToken = $passwordResetToken;

        return $this;
    }
    
}