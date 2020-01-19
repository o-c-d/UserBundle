<?php

namespace Ocd\UserBundle\Model;

abstract class OcdGroupAbstract implements OcdGroupInterface
{

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
     * @return string
     */
    public function __toString():string
    {
        return (string) $this->getName();
    }

}