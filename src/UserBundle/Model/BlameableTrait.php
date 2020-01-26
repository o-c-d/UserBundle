<?php

namespace Ocd\UserBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Ocd\UserBundle\Model\OcdUserInterface;

/**
 * Blameable Trait
 *
 */
trait BlameableTrait
{
    /**
     * @var OcdUserInterface
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @var OcdUserInterface
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="updated_by", referencedColumnName="id")
     */
    private $updatedBy;

    /**
     * {@inheritdoc}
     */
    public function setCreatedBy(?OcdUserInterface $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedBy() :?OcdUserInterface
    {
        return $this->createdBy;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedBy(?OcdUserInterface $updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedBy() :?OcdUserInterface
    {
        return $this->updatedBy;
    }
}
