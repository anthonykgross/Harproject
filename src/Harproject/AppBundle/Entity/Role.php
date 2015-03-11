<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="harp_role")
 * @ORM\Entity
 */
class Role
{
    static $basic_roles = array(
        "PROJECT_VIEW",
        "PROJECT_ADD",
        "PROJECT_DELETE",
        "PROJECT_EDIT",
        
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
    );
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=32)
     */
    private $label;


    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;
    
    /**
     * @ORM\OneToMany(targetEntity="Member", mappedBy="role", cascade={"remove", "persist"})
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
     * Set label
     *
     * @param string $label
     * @return Role
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
     * Set roles
     *
     * @param array $roles
     * @return Role
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
     * @return Role
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
