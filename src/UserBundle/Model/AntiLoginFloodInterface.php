<?php

namespace Ocd\UserBundle\Model;

use \DateTimeInterface;

interface AntiLoginFloodInterface
{
    /**
     *  Get count consecutive Login Try on this account with a wrong password
     *
     * @return integer
     */
    public function getPassFails(): int;

    /**
     * Set count consecutive Login Try on this account with a wrong password
     *
     * @param integer $passFails
     * @return self
     */
    public function setPassFails(int $passFails);
    public function newLoginFail();
    public function newLoginSuccess();
    public function getLastFailAt(): ?DateTimeInterface;
    public function setLastFailAt(?DateTimeInterface $lastTry);
    public function getLastSeenAt(): ?DateTimeInterface;
    public function setLastSeenAt(?DateTimeInterface $lastSeen);
    public function getLastIP(): ?string;
    public function setLastIP(?string $lastIP);
    public function getLastUA(): ?string;
    public function setLastUA(?string $lastUA);

}

