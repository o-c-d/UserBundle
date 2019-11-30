<?php

namespace Ocd\UserBundle\Model;

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
    public function setPassFails(int $passFails): self;
    public function getLastFailAt(): ?\DateTime;
    public function setLastFailAt(\DateTime $lastTry): self;
    public function getLastSeenAt(): ?\DateTime;
    public function setLastSeenAt(\DateTime $lastSeen): self;
    public function getLastSeen(): ?\DateTime;
    public function setLastSeen(\DateTime $lastSeen): self;
    public function getLastIP(): ?\DateTime;
    public function setLastIP(?\DateTime $lastIP): self;
    public function getLastUA(): ?\DateTime;
    public function setLastUA(?\DateTime $lastUA): self;

}

