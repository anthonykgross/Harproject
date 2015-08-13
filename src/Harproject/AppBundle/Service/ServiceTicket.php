<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */

namespace Harproject\AppBundle\Service;

use Harproject\AppBundle\Entity\Task;
use Harproject\AppBundle\Entity\Ticket;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Entity\TaskHasTicket;


class ServiceTicket {
    
    private $em;
    private $container;
    
    public function __construct($container) {
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    /**
     * Create a new ticket and assign it to the Task
     * @param Task $task
     * @param Member $author
     * @param String $description
     * @return Task
     */
    public function addTicket(Task $task, Member $author, $description = null){
        
        $ticket         = new Ticket();
        
        $ticket->setCreatedAt(new \DateTime())
                ->setDescription($description)
                ->setMember($author);
        
        $this->assignTicket($ticket, $task);
        
        $this->em->persist($task);
        $this->em->flush();
        
        return $task;
    }
   
    /**
     * Assign the ticket to the Task (Ticket MAY be refered by several Tasks)
     * @param Ticket $ticket
     * @param Task $task
     * @return TaskHasTicket
     */
    public function assignTicket(Ticket $ticket, Task $task){
        $taskHasTicket  = new TaskHasTicket();
        
        $taskHasTicket->setCreatedAt(new \DateTime())
                ->setTicket($ticket)
                ->setTask($task);
        
        $this->em->persist($taskHasTicket);
        $this->em->flush();
        
        return $taskHasTicket;
    }
    
    /**
     * Remove an existing ticket
     * @param Ticket $ticket
     */
    public function deleteTicket(Ticket $ticket) {
        $this->em->remove($ticket);
        $this->em->flush();
    }
    
}