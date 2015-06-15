<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 *
 * @ORM\Table(name="harp_Group")
 * @ORM\Entity
 */
class Group
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
     * @ORM\OneToMany(targetEntity="Member", mappedBy="group", cascade={"remove", "persist"})
     */
    private $members;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created_at           = new \DateTime();
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Group
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
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
