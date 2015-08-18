<?php

/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */

namespace Harproject\AppBundle\Service;

use \Harproject\AppBundle\Entity\MemberHasTask;
use \Harproject\AppBundle\Entity\TimeTracker;
use Harproject\AppBundle\Exception\Exception;

class ServiceTimeTracker {
    
    private $em;
    private $container;
    
    public function __construct($container) {
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    /**
     * Run a new timeTracker if it doesn't exist otherwise, stop it.
     * @param MemberHasTask $memberHasTask
     * @param string $comment
     * @return TimeTracker
     */
    public function runTimeTracker(MemberHasTask $memberHasTask, $comment = null){
        //Check if a timetracker is running
        $timetracker = $this->em->getRepository("HarprojectAppBundle:TimeTracker")->findOneBy(array(
            "memberHasTask"     => $memberHasTask,
            "finished_at"       => null
        ));

        if($timetracker){
            $this->clearTimetracker($memberHasTask);
        }
        else{
            $timetracker = new TimeTracker();
            $timetracker->setMemberHasTask($memberHasTask);
        }
        
        if(!is_null($comment)){
            $timetracker->setComment($comment);
        }
        
        $this->em->persist($timetracker);
        $this->em->flush();
        
        return $timetracker;
    }
    
    
    /**
     * Clear timetrackers. Return True if timetracker was found.
     * @param MemberHasTask $memberHasTask
     * @return Boolean
     */
    public function clearTimetracker(MemberHasTask $memberHasTask){
        $timetracker = $this->em->getRepository("HarprojectAppBundle:TimeTracker")->findOneBy(array(
            "memberHasTask"     => $memberHasTask,
            "finished_at"       => null
        ));

        if($timetracker){
            $timetracker->setFinishedAt(new \DateTime());
            
            $task = $memberHasTask->getTask();
            $task->setSpentTime($task->getSpentTime()+($timetracker->getFinishedAt()->getTimestamp() - $timetracker->getCreatedAt()->getTimestamp()));
            $this->em->persist($task);
        }
        
        return ($timetracker);
    }
}