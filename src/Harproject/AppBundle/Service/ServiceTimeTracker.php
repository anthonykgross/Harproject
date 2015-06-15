<?php

/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */

namespace Harproject\AppBundle\Service;

use \Harproject\AppBundle\Entity\MemberHasTask;
use \Harproject\AppBundle\Entity\TimeTracker;

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
            "MemberHasTask" => $memberHasTask,
            "endDate"       => null
        ));
        
        if($timetracker){
            $timetracker->setEndDate(new \DateTime());
        }
        else{
            $timetracker = new TimeTracker();
            $timetracker->setStartDate(new \DateTime());
        }
        
        if(!is_null($comment)){
            $timetracker->setComment($comment);
        }
        
        $this->em->persist($timetracker);
        $this->em->flush();
        
        return $timetracker;
    }
}