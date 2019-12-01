<?php

namespace Ocd\UserBundle\Model;

use \DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * Timestampable Trait
 * @ORM\HasLifecycleCallbacks()
 *
 */
trait TimestampableTrait
{
    /**
     * Creation DateTime
     * @var DateTimeInterface
     * 
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;
    
    /**
     * Update DateTime
     * @var DateTimeInterface
     * 
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * Sets createdAt.
     *
     * @param  DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Returns createdAt.
     *
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Sets updatedAt.
     *
     * @param  DateTimeInterface $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTimeInterface $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Returns updatedAt.
     *
     * @return \DateTimeInterface
     */
    public function getUpdatedAt() :DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Automatic Update Date
     *
     * @ORM\PreUpdate
     */
    public function autoUpdatedAt() :void
    {
        $this->setUpdatedAt(new \Datetime());
    }

    /**
     * Automatic Creation Date
     *
     * @ORM\PrePersist
     */
    public function autoCreatedAt() :void
    {
        $this->setCreatedAt(new \Datetime());
        $this->setUpdatedAt(new \Datetime());
    }
}