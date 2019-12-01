<?php

namespace Ocd\UserBundle\Model;

use \DateTimeInterface;

interface TimestampableInterface
{
    public function setCreatedAt(DateTimeInterface $createdAt);
    public function getCreatedAt() :DateTimeInterface;
    public function setUpdatedAt(DateTimeInterface $updatedAt);
    public function getUpdatedAt() :DateTimeInterface;
    public function autoCreatedAt() :void;
    public function autoUpdatedAt() :void;

}

