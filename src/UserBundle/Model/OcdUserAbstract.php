<?php

namespace Ocd\UserBundle\Model;

use Doctrine\ORM\Mapping as ORM;

abstract class OcdUserAbstract implements
    SymfonyUserInterface,
    OcdUserInterface,
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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return (string) $this->getUsername();
    }

    
    /**
     * {@inheritdoc}
     */
    public function serialize():string
    {
        return serialize([
            $this->getId(),
            $this->getUsername(),
            $this->getPassword(),
            $this->getPasswordExpiredAt(),
            $this->getAccountDeletedAt(),
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized):self
    {
        [
            $id,
            $username,
            $password,
            $passwordExpiredAt,
            $accountDeletedAt,
        ] = unserialize($serialized, ['allowed_classes' => false]);
        $this->setId($id);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setPasswordExpiredAt($passwordExpiredAt);
        $this->setAccountDeletedAt($accountDeletedAt);
        return $this;
    }
}
