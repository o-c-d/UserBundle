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
    public function setCreatedBy( $createdBy);

    /**
     * Returns createdBy.
     *
     * @return OcdUserInterface
     */
    public function getCreatedBy();

    /**
     * Sets updatedBy.
     *
     * @param  $updatedBy
     * @return $this
     */
    public function setUpdatedBy($updatedBy);

    /**
     * Returns updatedBy.
     *
     * @return OcdUserInterface
     */
    public function getUpdatedBy();
}
