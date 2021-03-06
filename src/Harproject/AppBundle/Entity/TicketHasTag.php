<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * TicketHasTag
 *
 * @ORM\Table(name="harp_Ticket_has_Tag", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Ticket_id", "Tag_id"})})
 * @ORM\Entity
 */
class TicketHasTag extends Harproject
{
    /**
     * @var \Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="ticketHasTags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tag_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $tag;
         
    /**
     * @var \Ticket
     *
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="ticketHasTags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ticket_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $ticket;

    public function __construct() {
        parent::__construct();
    }
    /**
     * Set tag
     *
     * @param \Harproject\AppBundle\Entity\Tag $tag
     * @return TicketHasTag
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
     * Set ticket
     *
     * @param \Harproject\AppBundle\Entity\Ticket $ticket
     * @return TicketHasTag
     */
    public function setTicket(\Harproject\AppBundle\Entity\Ticket $ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \Harproject\AppBundle\Entity\Ticket 
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
