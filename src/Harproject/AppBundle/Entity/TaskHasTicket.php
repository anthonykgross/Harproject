<?php

namespace Harproject\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Harproject\AppBundle\Entity\Harproject;

/**
 * TaskHasTicket
 *
 * @ORM\Table(name="harp_Task_has_Ticket", uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"Ticket_id", "Task_id"})})
 * @ORM\Entity
 */
class TaskHasTicket extends Harproject
{
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

    public function __construct() {
        parent::__construct();
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
