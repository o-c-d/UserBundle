<?php

namespace Ocd\UserBundle\Model;

use Doctrine\ORM\Mapping as ORM;

trait OcdUserTrait
{
    use SymfonyUserTrait;
    use AdvancedUserTrait;
    use AntiLoginFloodTrait;
    use ResetablePasswordTrait;


    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->expired_at,
            $this->deleted_at,
            $this->is_locked,
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        [
            $this->id,
            $this->username,
            $this->password,
            $this->expired_at,
            $this->deleted_at,
            $this->is_locked,
        ] = unserialize($serialized, ['allowed_classes' => false]);
    }
}