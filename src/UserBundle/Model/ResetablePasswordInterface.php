<?php

namespace Ocd\UserBundle\Model;

use \DateTimeInterface;

interface ResetablePasswordInterface
{
    public function getPasswordResetRequestedAt() :DateTimeInterface;
    public function setPasswordResetRequestedAt(DateTimeInterface $passwordResetRequestedAt);
    public function getPasswordResetToken() :?string;
    public function setPasswordResetToken(?string $passwordResetToken);

}

