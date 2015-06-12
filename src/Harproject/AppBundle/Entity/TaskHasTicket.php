<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskHasTicket
 *
 * @ORM\Table(name="harp_Task_has_Ticket", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Ticket_id", "Task_id"})})
 * @ORM\Entity
 */
class TaskHasTicket
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
     * @var \Task
     *
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="taskHasTickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Task_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $task;
         
    /**
     * @var \Ticket
     *
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="taskHasTickets")
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return TaskHasTicket
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
     * Set task
     *
     * @param \Harproject\AppBundle\Entity\Task $task
     * @return TaskHasTicket
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
     * Set ticket
     *
     * @param \Harproject\AppBundle\Entity\Ticket $ticket
     * @return TaskHasTicket
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
