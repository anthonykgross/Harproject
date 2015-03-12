<?php

namespace Harproject\AppBundle\Service;

use Harproject\AppBundle\Entity\Task;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Member;

use Harproject\AppBundle\Exception\Exception;
use Symfony\Component\Security\Core\Util\SecureRandom;

class ServiceTask {
    
    private $em;
    private $container;
    
    public function __construct($container) {
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    /**
     * Register a new user
     * @param type $project
     * @param type $creator
     * @throws Exception
     * @return User
     */
    public function addTask( Project $project, Member $creator, $name ){
        
        $task = new Task();
        $task->setCreator( $creator );
        $task->setName($name);
        $task->setProject( $project );
        $task->setDescription("");
        
        $this->em->persist($task);
        $this->em->flush();
        
        return $task;
    }
   
    /**
     * Remove an existing task
     * @param type $task
     * @throws Exception
     * @return User
     */
    public function deleteTask( Task $task ) {
        
        $this->em->remove($task);
        $this->em->flush();
    }
}