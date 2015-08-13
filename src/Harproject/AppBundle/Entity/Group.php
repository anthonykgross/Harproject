<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * Group
 *
 * @ORM\Table(name="harp_Group")
 * @ORM\Entity
 */
class Group extends Harproject
{
    static $basic_roles = array(
        "MEMBER_VIEW",
        "MEMBER_ADD",
        "MEMBER_DELETE",
        "MEMBER_EDIT",
        
        "TICKET_VIEW",
        "TICKET_ADD",
        "TICKET_DELETE",
        "TICKET_EDIT",
        
        "TASK_VIEW",
        "TASK_ADD",
        "TASK_DELETE",
        "TASK_EDIT",
        
        "STATUS_VIEW",
        "STATUS_ADD",
        "STATUS_DELETE",
        "STATUS_EDIT",
        
        "TIMETRACKER_VIEW",
        "TIMETRACKER_ADD",
        "TIMETRACKER_DELETE",
        "TIMETRACKER_EDIT",
        
        "RELATION_VIEW",
        "RELATION_ADD",
        "RELATION_DELETE",
        "RELATION_EDIT",
    );

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=32)
     */
    private $label;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_locked", type="boolean")
     */
    private $is_locked;
    
    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;
    
    /**
     * @ORM\OneToMany(targetEntity="Member", mappedBy="group", cascade={"remove", "persist"})
     */
    private $members;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->is_locked    = false;
        $this->members      = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set label
     *
     * @param string $label
     * @return Group
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * Set is_locked
     *
     * @param boolean $is_locked
     * @return Group
     */
    public function setIsLocked($is_locked)
    {
        $this->is_locked = $is_locked;

        return $this;
    }

    /**
     * Get is_locked
     *
     * @return boolean 
     */
    public function getIsLocked()
    {
        return $this->is_locked;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return Group
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add members
     *
     * @param \Harproject\AppBundle\Entity\Member $members
     * @return Group
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
