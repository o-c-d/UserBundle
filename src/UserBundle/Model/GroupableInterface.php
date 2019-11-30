<?php 

namespace Ocd\UserBundle\Model;

interface GroupableInterface
{

    /**
     * {@inheritdoc}
     */
    public function getGroups();

    /**
     * {@inheritdoc}
     */
    public function getGroupNames();

    /**
     * {@inheritdoc}
     */
    public function hasGroup($name);

    /**
     * {@inheritdoc}
     */
    public function addGroup(GroupInterface $group);

    /**
     * {@inheritdoc}
     */
    public function removeGroup(GroupInterface $group);
}
