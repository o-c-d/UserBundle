<?php

namespace Ocd\UserBundle\Model;

interface AdvancedUserInterface
{
    public function getPasswordExpiredAt();
    public function setPasswordExpiredAt();
    public function getAccountDeletedAt();
    public function setAccountDeletedAt();
    public function getAccountExpiredAt();
    public function setAccountExpiredAt();
    public function getAccountLockedAt();
    public function setAccountLockedAt();
    public function getAccountIsEnabled();
    public function setAccountIsEnabled();

    public function isAccountNonExpired();
    public function isAccountNonLocked();
    public function isCredentialsNonExpired();
    public function isEnabled();
}

