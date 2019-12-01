<?php

namespace Ocd\UserBundle\Model;

use \DateTimeInterface;

interface AdvancedUserInterface
{
    public function getPasswordExpiredAt() :?DateTimeInterface;
    public function setPasswordExpiredAt(?DateTimeInterface $passwordExpiredAt);
    public function getAccountDeletedAt() :?DateTimeInterface;
    public function setAccountDeletedAt(?DateTimeInterface $accountDeletedAt);
    public function getAccountExpiredAt() :?DateTimeInterface;
    public function setAccountExpiredAt(?DateTimeInterface $accountExpiredAt);
    public function getAccountLockedAt() :?DateTimeInterface;
    public function setAccountLockedAt(?DateTimeInterface $accountLockedAt);
    public function getAccountIsEnabled() :bool;
    public function setAccountIsEnabled(bool $accountIsEnabled);

    public function isAccountNonExpired() :bool;
    public function isAccountNonLocked() :bool;
    public function isCredentialsNonExpired() :bool;
    public function isEnabled() :bool;
}

