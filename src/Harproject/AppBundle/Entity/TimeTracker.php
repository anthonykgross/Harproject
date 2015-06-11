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
}
