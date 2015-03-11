<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="harp_project")
 * @ORM\Entity
 */
class Project
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Member", mappedBy="project", cascade={"remove", "persist"})
     */
    private $members;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add members
     *
     * @param \Harproject\AppBundle\Entity\Member $members
     * @return Project
     */
    public function addMember(\Harproject\AppBundle\Entity\Member $members)
    {
        $this->members[] = $members;

        return $this;
    }

    /**
     * Remove members
     *
     * @param \Harproject\AppBundle\Entity\Member $members
     */
    public function removeMember(\Harproject\AppBundle\Entity\Member $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->members;
    }
}
