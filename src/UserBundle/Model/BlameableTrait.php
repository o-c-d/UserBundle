<?php

namespace Ocd\UserBundle\Model;

use Ocd\UserBundle\Model\OcdUserInterface;

/**
 * Blameable Trait
 *
 */
trait BlameableTrait
{
    /**
     * @var OcdUserInterface
     */
    private $createdBy;

    /**
     * @var OcdUserInterface
     */
    private $updatedBy;

    /**
     * {@inheritdoc}
     */
    public function setCreatedBy( $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedBy( $updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
}
