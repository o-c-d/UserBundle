<?php

namespace Ocd\UserBundle\Model;

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
     * @var \DateTime
     * 
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;
    
    /**
     * Update DateTime
     * @var \DateTime
     * 
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * Sets createdAt.
     *
     * @param  \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Returns createdAt.
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets updatedAt.
     *
     * @param  \DateTimeInterface $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Returns updatedAt.
     *
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Automatic Update Date
     *
     * @ORM\PreUpdate
     */
    public function autoUpdatedAt()
    {
        $this->setUpdatedAt(new \Datetime());
    }

    /**
     * Automatic Creation Date
     *
     * @ORM\PrePersist
     */
    public function autoCreatedAt()
    {
        $this->setCreatedAt(new \Datetime());
        $this->setUpdatedAt(new \Datetime());
    }
}