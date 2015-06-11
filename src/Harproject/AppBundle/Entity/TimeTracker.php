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
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $start_date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
     */
    private $end_date;

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
        $this->timeTrackerHasTags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set start_date
     *
     * @param \DateTime $startDate
     * @return TimeTracker
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get start_date
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set end_date
     *
     * @param \DateTime $endDate
     * @return TimeTracker
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;

        return $this;
    }

    /**
     * Get end_date
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->end_date;
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
