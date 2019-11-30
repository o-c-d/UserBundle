<?php

namespace Ocd\UserBundle\Model;

interface ResetablePasswordInterface
{
    public function getPasswordResetRequestedAt();
    public function setPasswordResetRequestedAt();
    public function getPasswordResetToken();
    public function setPasswordResetToken();

}

