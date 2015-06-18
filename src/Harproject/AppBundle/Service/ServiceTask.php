<?php
/**
 * @author Clement Vidal <clemenvidalperso@gmail.com>
 */

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
     * @param Project $project
     * @param Member $author
     * @param string $name
     * @return Task
     */
    public function addTask( Project $project, Member $author, $name , $description = null, $estimatedTime = 0, $spentTime = 0){
        
        $task = new Task();
        $task->setAuthor( $author );
        $task->setName($name);
        $task->setProject( $project );
        $task->setDescription($description);
        $task->setEstimatedTime($estimatedTime);
        $task->setSpentTime($spentTime);
        $this->em->persist($task);
        $this->em->flush();
        
        return $task;
    }
   
    /**
     * Remove an existing task
     * @param Task $task
     */
    public function deleteTask(Task $task) {
        $task->setDeletedAt(new \DateTime());
        $this->em->persist($task);
        $this->em->flush();
    }
    
    /**
     * Get all tasks assigned to one Member
     * @param type $member
     * @return HarTask[]
     */
    public function getTask( Member $assigne ){
        return $task;
    }
}