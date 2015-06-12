<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketHasTag
 *
 * @ORM\Table(name="harp_Ticket_has_Tag", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Ticket_id", "Tag_id"})})
 * @ORM\Entity
 */
class TicketHasTag
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

    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    

    public function __construct() {
        $this->created_at = new \DateTime();
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

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return TicketHasTag
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
}
