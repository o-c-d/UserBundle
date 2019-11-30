<?php

namespace Ocd\UserBundle\Model;

abstract class OcdUserAbstract implements
    SymfonyUserInterface,
    AdvancedUserInterface,
    TimestampableInterface,
    ResetablePasswordInterface,
    AntiLoginFloodInterface,
    \Serializable
{
    use SymfonyUserTrait;
    use AdvancedUserTrait;
    use TimestampableTrait;
    use ResetablePasswordTrait;
    use AntiLoginFloodTrait;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getUsername();
    }

    
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
