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
        
        $timetrackers_pending = $this->em->getRepository("HarprojectAppBundle:TimeTracker")->findTimetrackerExceptOne($memberHasTask->getTask()->getId(), $memberHasTask->getMember()->getUser());
        
        if(count($timetrackers_pending)>0){
            throw new Exception("Member can run only one tracker at the same time.");
        }
        
        if($timetracker){
            $timetracker->setFinishedAt(new \DateTime());
            
            $task = $memberHasTask->getTask();
            $task->setSpentTime($task->getSpentTime()+($timetracker->getFinishedAt()->getTimestamp() - $timetracker->getCreatedAt()->getTimestamp()));
            $this->em->persist($task);
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
}