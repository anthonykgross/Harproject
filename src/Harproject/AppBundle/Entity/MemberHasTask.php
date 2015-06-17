<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * MemberHasTask
 *
 * @ORM\Table(name="harp_Member_has_Task", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Member_id", "Task_id"})})
 * @ORM\Entity
 */
class MemberHasTask extends Harproject
{     
    /**
     * @var \Member
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="memberHasTasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Member_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $member;
         
    /**
     * @var \Task
     *
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="memberHasTasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Task_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $task;

     /**
     * @ORM\OneToMany(targetEntity="TimeTracker", mappedBy="memberHasTasks", cascade={"remove", "persist"})
     */
    private $timeTrackers;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->timeTrackers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set member
     *
     * @param \Harproject\AppBundle\Entity\Member $member
     * @return MemberHasTask
     */
    public function setMember(\Harproject\AppBundle\Entity\Member $member)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \Harproject\AppBundle\Entity\Member 
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set task
     *
     * @param \Harproject\AppBundle\Entity\Task $task
     * @return MemberHasTask
     */
    public function setTask(\Harproject\AppBundle\Entity\Task $task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \Harproject\AppBundle\Entity\Task 
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Add timeTrackers
     *
     * @param \Harproject\AppBundle\Entity\TimeTracker $timeTrackers
     * @return MemberHasTask
     */
    public function addTimeTracker(\Harproject\AppBundle\Entity\TimeTracker $timeTrackers)
    {
        $this->timeTrackers[] = $timeTrackers;

        return $this;
    }

    /**
     * Remove timeTrackers
     *
     * @param \Harproject\AppBundle\Entity\TimeTracker $timeTrackers
     */
    public function removeTimeTracker(\Harproject\AppBundle\Entity\TimeTracker $timeTrackers)
    {
        $this->timeTrackers->removeElement($timeTrackers);
    }

    /**
     * Get timeTrackers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTimeTrackers()
    {
        return $this->timeTrackers;
    }
}
