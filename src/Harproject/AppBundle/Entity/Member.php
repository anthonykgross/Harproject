<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;


/**
 * Member
 *
 * @ORM\Table(name="harp_Member")
 * @ORM\Entity
 */
class Member extends Harproject
{
    /**
     * @var \Group
     *
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="members")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Group_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $group;
    
     /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="members")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $user;

    /**
     * @var \Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="members")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Project_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $project;
    
    /**
     * @ORM\OneToMany(targetEntity="MemberHasTask", mappedBy="member", cascade={"remove", "persist"})
     */
    private $memberHasTasks;
    
    /**
     * Define the relation between this member and tasks it has created
     * 
     * @ORM\OneToMany(targetEntity="Task", mappedBy="author")
     */
    private $createdTasks;
    
    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="member", cascade={"remove", "persist"})
     */
    private $tickets;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->memberHasTasks   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdTasks     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tickets          = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set group
     *
     * @param \Harproject\AppBundle\Entity\Group $group
     * @return Member
     */
    public function setGroup(\Harproject\AppBundle\Entity\Group $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Harproject\AppBundle\Entity\Group 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set user
     *
     * @param \Harproject\AppBundle\Entity\User $user
     * @return Member
     */
    public function setUser(\Harproject\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Harproject\AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set project
     *
     * @param \Harproject\AppBundle\Entity\Project $project
     * @return Member
     */
    public function setProject(\Harproject\AppBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Harproject\AppBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Add memberHasTasks
     *
     * @param \Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks
     * @return Member
     */
    public function addMemberHasTask(\Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks)
    {
        $this->memberHasTasks[] = $memberHasTasks;

        return $this;
    }

    /**
     * Remove memberHasTasks
     *
     * @param \Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks
     */
    public function removeMemberHasTask(\Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks)
    {
        $this->memberHasTasks->removeElement($memberHasTasks);
    }

    /**
     * Get memberHasTasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMemberHasTasks()
    {
        return $this->memberHasTasks;
    }

    /**
     * Add createdTasks
     *
     * @param \Harproject\AppBundle\Entity\Task $createdTasks
     * @return Member
     */
    public function addCreatedTask(\Harproject\AppBundle\Entity\Task $createdTasks)
    {
        $this->createdTasks[] = $createdTasks;

        return $this;
    }

    /**
     * Remove createdTasks
     *
     * @param \Harproject\AppBundle\Entity\Task $createdTasks
     */
    public function removeCreatedTask(\Harproject\AppBundle\Entity\Task $createdTasks)
    {
        $this->createdTasks->removeElement($createdTasks);
    }

    /**
     * Get createdTasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreatedTasks()
    {
        return $this->createdTasks;
    }

    /**
     * Add tickets
     *
     * @param \Harproject\AppBundle\Entity\Ticket $tickets
     * @return Member
     */
    public function addTicket(\Harproject\AppBundle\Entity\Ticket $tickets)
    {
        $this->tickets[] = $tickets;

        return $this;
    }

    /**
     * Remove tickets
     *
     * @param \Harproject\AppBundle\Entity\Ticket $tickets
     */
    public function removeTicket(\Harproject\AppBundle\Entity\Ticket $tickets)
    {
        $this->tickets->removeElement($tickets);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTickets()
    {
        return $this->tickets;
    }
    
    public function getLabelForm(){
        return "[".$this->getGroup()->getLabel()."] ".$this->user->getEmail();
    }
}
