<?php 

namespace Ocd\UserBundle\Model;

use Ocd\UserBundle\Model\OcdUserInterface;

interface BlameableInterface
{

    /**
     * Sets createdBy.
     *
     * @param   $createdBy
     * @return $this
     */
    public function setCreatedBy(?OcdUserInterface $createdBy);

    /**
     * Returns createdBy.
     *
     * @return OcdUserInterface
     */
    public function getCreatedBy() :?OcdUserInterface;

    /**
     * Sets updatedBy.
     *
     * @param  $updatedBy
     * @return $this
     */
    public function setUpdatedBy(?OcdUserInterface$updatedBy);

    /**
     * Returns updatedBy.
     *
     * @return OcdUserInterface
     */
    public function getUpdatedBy() :?OcdUserInterface;
}
