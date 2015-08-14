<?php
/**
 * @author Clement Vidal <clemenvidalperso@gmail.com>
 */

namespace Harproject\AppBundle\Service;

use Harproject\AppBundle\Entity\Task;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Entity\MemberHasTask;
use Harproject\AppBundle\Entity\User;

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
    public function addTask(Project $project, Member $author, $name , $description = null, $estimatedTime = 0, $spentTime = 0){
        
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
        $this->em->remove($task);
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
    
    /**
     * User can select a Task
     * @param Task $task
     * @param \Harproject\AppBundle\Service\User $user
     * @throws Exception
     */
    public function selectTask(Task $task, User $user){
        $members = $this->container->get('harproject_app.user')->getMembers($user, $task->getProject());
        
        if(count($members)==0){
            throw new Exception("Only members can select this Task.");
        }
        
        if(!is_null($this->getSelecter($task))){
            throw new Exception("This Task is already selected.");
        }
        
        $memberHasTask = new MemberHasTask();
        $memberHasTask->setMember($members[0])->setTask($task);
        
        $this->em->persist($memberHasTask);
        $this->em->flush();
    }
    
    /**
     * Return True id the task is selected
     * @param Task $task
     * @return boolean
     */
    public function isSelected(Task $task){
        return !(is_null($this->getSelecter($task)));
    }
    
    /**
     * Return the member who has selected the task
     * @param Task $task
     * @return Member|NULL
     */
    public function getSelecter(Task $task){
        $memberHasTask = $this->em->getRepository("HarprojectAppBundle:MemberHasTask")->findOneBy(array(
            "task"          => $task,
            "deleted_at"    => null
        ));
        
        if($memberHasTask){
            return $memberHasTask->getMember();
        }
        else{
            return null;
        }
    }
    
    /**
     * User can deselect a Task
     * @param Task $task
     * @param \Harproject\AppBundle\Service\User $user
     * @throws Exception
     */
    public function deselectTask(Task $task, User $user){
        $members = $this->container->get('harproject_app.user')->getMembers($user, $task->getProject());
        
        if(count($members)==0){
            throw new Exception("Only members can select this Task.");
        }
        
        $memberHasTask = $this->em->getRepository("HarprojectAppBundle:MemberHasTask")->findOneBy(array(
            "task"          => $task,
            "member"        => $this->em->getRepository("HarprojectAppBundle:Member")->findOneBy(array(
                "user"      => $user
            ))
        ));
        
        if(!$memberHasTask){
            throw new Exception("User can't deselect this Task.");
        }
        
        $this->em->remove($memberHasTask);
        $this->em->flush();
    }
}