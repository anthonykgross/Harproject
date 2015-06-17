<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * Ticket
 *
 * @ORM\Table(name="harp_Ticket")
 * @ORM\Entity
 */
class Ticket extends Harproject
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \Member
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="tickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Member_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $member;
    
    /**
     * @ORM\OneToMany(targetEntity="TicketHasTag", mappedBy="ticket", cascade={"remove", "persist"})
     */
    private $ticketHasTags;
    
    /**
     * @ORM\OneToMany(targetEntity="TaskHasTicket", mappedBy="ticket", cascade={"remove", "persist"})
     */
    private $taskHasTickets;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->ticketHasTags    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taskHasTickets   = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Ticket
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set member
     *
     * @param \Harproject\AppBundle\Entity\Member $member
     * @return Ticket
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
     * Add ticketHasTags
     *
     * @param \Harproject\AppBundle\Entity\TicketHasTag $ticketHasTags
     * @return Ticket
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
     * Add taskHasTickets
     *
     * @param \Harproject\AppBundle\Entity\TaskHasTicket $taskHasTickets
     * @return Ticket
     */
    public function addTaskHasTicket(\Harproject\AppBundle\Entity\TaskHasTicket $taskHasTickets)
    {
        $this->taskHasTickets[] = $taskHasTickets;

        return $this;
    }

    /**
     * Remove taskHasTickets
     *
     * @param \Harproject\AppBundle\Entity\TaskHasTicket $taskHasTickets
     */
    public function removeTaskHasTicket(\Harproject\AppBundle\Entity\TaskHasTicket $taskHasTickets)
    {
        $this->taskHasTickets->removeElement($taskHasTickets);
    }

    /**
     * Get taskHasTickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaskHasTickets()
    {
        return $this->taskHasTickets;
    }
}
