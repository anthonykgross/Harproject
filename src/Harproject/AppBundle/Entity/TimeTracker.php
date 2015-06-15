<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeTracker
 *
 * @ORM\Table(name="harp_TimeTracker")
 * @ORM\Entity
 */
class TimeTracker
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
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var datetime
     *
     * @ORM\Column(name="finished_at", type="datetime")
     */
    private $finished_at;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;


    /**
     * @var \MemberHasTask
     *
     * @ORM\ManyToOne(targetEntity="MemberHasTask", inversedBy="timeTrackers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Member_has_Task_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $memberHasTasks;
    
    /**
     * @ORM\OneToMany(targetEntity="TimeTrackerHasTag", mappedBy="timeTracker", cascade={"remove", "persist"})
     */
    private $timeTrackerHasTags;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->timeTrackerHasTags   = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return TimeTracker
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
     * Set finished_at
     *
     * @param \DateTime $finishedAt
     * @return TimeTracker
     */
    public function setFinishedAt($finishedAt)
    {
        $this->finished_at = $finishedAt;

        return $this;
    }

    /**
     * Get finished_at
     *
     * @return \DateTime 
     */
    public function getFinishedAt()
    {
        return $this->finished_at;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return TimeTracker
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set memberHasTasks
     *
     * @param \Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks
     * @return TimeTracker
     */
    public function setMemberHasTasks(\Harproject\AppBundle\Entity\MemberHasTask $memberHasTasks)
    {
        $this->memberHasTasks = $memberHasTasks;

        return $this;
    }

    /**
     * Get memberHasTasks
     *
     * @return \Harproject\AppBundle\Entity\MemberHasTask 
     */
    public function getMemberHasTasks()
    {
        return $this->memberHasTasks;
    }

    /**
     * Add timeTrackerHasTags
     *
     * @param \Harproject\AppBundle\Entity\TimeTrackerHasTag $timeTrackerHasTags
     * @return TimeTracker
     */
    public function addTimeTrackerHasTag(\Harproject\AppBundle\Entity\TimeTrackerHasTag $timeTrackerHasTags)
    {
        $this->timeTrackerHasTags[] = $timeTrackerHasTags;

        return $this;
    }

    /**
     * Remove timeTrackerHasTags
     *
     * @param \Harproject\AppBundle\Entity\TimeTrackerHasTag $timeTrackerHasTags
     */
    public function removeTimeTrackerHasTag(\Harproject\AppBundle\Entity\TimeTrackerHasTag $timeTrackerHasTags)
    {
        $this->timeTrackerHasTags->removeElement($timeTrackerHasTags);
    }

    /**
     * Get timeTrackerHasTags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTimeTrackerHasTags()
    {
        return $this->timeTrackerHasTags;
    }
}
