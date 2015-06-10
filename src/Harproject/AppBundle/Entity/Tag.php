<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="harp_tag")
 * @ORM\Entity
 */
class Tag
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
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=32)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="TicketHasTag", mappedBy="tag", cascade={"remove", "persist"})
     */
    private $ticketHasTags;
    
    /**
     * @ORM\OneToMany(targetEntity="TaskHasTag", mappedBy="tag", cascade={"remove", "persist"})
     */
    private $taskHasTags;
    
    /**
     * @ORM\OneToMany(targetEntity="TimeTrackerHasTag", mappedBy="tag", cascade={"remove", "persist"})
     */
    private $timeTrackerHasTags;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ticketHasTags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taskHasTags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set label
     *
     * @param string $label
     * @return Tag
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
     * Add ticketHasTags
     *
     * @param \Harproject\AppBundle\Entity\TicketHasTag $ticketHasTags
     * @return Tag
     */
    public function addTicketHasTag(\Harproject\AppBundle\Entity\TicketHasTag $ticketHasTags)
    {
        $this->ticketHasTags[] = $ticketHasTags;

        return $this;
    }

    /**
     * Remove ticketHasTags
     *
     * @param \Harproject\AppBundle\Entity\TicketHasTag $ticketHasTags
     */
    public function removeTicketHasTag(\Harproject\AppBundle\Entity\TicketHasTag $ticketHasTags)
    {
        $this->ticketHasTags->removeElement($ticketHasTags);
    }

    /**
     * Get ticketHasTags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTicketHasTags()
    {
        return $this->ticketHasTags;
    }

    /**
     * Add taskHasTags
     *
     * @param \Harproject\AppBundle\Entity\TaskHasTag $taskHasTags
     * @return Tag
     */
    public function addTaskHasTag(\Harproject\AppBundle\Entity\TaskHasTag $taskHasTags)
    {
        $this->taskHasTags[] = $taskHasTags;

        return $this;
    }

    /**
     * Remove taskHasTags
     *
     * @param \Harproject\AppBundle\Entity\TaskHasTag $taskHasTags
     */
    public function removeTaskHasTag(\Harproject\AppBundle\Entity\TaskHasTag $taskHasTags)
    {
        $this->taskHasTags->removeElement($taskHasTags);
    }

    /**
     * Get taskHasTags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaskHasTags()
    {
        return $this->taskHasTags;
    }

    /**
     * Add timeTrackerHasTags
     *
     * @param \Harproject\AppBundle\Entity\TimeTrackerHasTag $timeTrackerHasTags
     * @return Tag
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
