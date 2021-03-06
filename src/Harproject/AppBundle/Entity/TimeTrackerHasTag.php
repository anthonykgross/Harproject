<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * TimeTrackerHasTag
 *
 * @ORM\Table(name="harp_TimeTracker_has_Tag", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"TimeTracker_id", "Tag_id"})})
 * @ORM\Entity
 */
class TimeTrackerHasTag extends Harproject
{
    /**
     * @var \Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="timeTrackerHasTags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tag_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $tag;
         
    /**
     * @var \TimeTracker
     *
     * @ORM\ManyToOne(targetEntity="TimeTracker", inversedBy="timeTrackerHasTags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TimeTracker_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $timeTracker;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Set tag
     *
     * @param \Harproject\AppBundle\Entity\Tag $tag
     * @return TimeTrackerHasTag
     */
    public function setTag(\Harproject\AppBundle\Entity\Tag $tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Harproject\AppBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set timeTracker
     *
     * @param \Harproject\AppBundle\Entity\TimeTracker $timeTracker
     * @return TimeTrackerHasTag
     */
    public function setTimeTracker(\Harproject\AppBundle\Entity\TimeTracker $timeTracker)
    {
        $this->timeTracker = $timeTracker;

        return $this;
    }

    /**
     * Get timeTracker
     *
     * @return \Harproject\AppBundle\Entity\TimeTracker 
     */
    public function getTimeTracker()
    {
        return $this->timeTracker;
    }
}
