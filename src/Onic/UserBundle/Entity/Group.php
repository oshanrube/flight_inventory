<?php

namespace Onic\UserBundle\Entity;

/**
 * Group
 */
class Group
{
    /**
     * @var integer
     */
    private $id;


    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $groups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add group
     * @param \Onic\UserBundle\Entity\Group $group
     * @return Group
     */
    public function addGroup(\Onic\UserBundle\Entity\Group $group)
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * Remove group
     * @param \Onic\UserBundle\Entity\Group $group
     */
    public function removeGroup(\Onic\UserBundle\Entity\Group $group)
    {
        $this->groups->removeElement($group);
    }

    /**
     * Get groups
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
