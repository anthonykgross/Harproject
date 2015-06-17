<?php
namespace Harproject\AppBundle\Tests\Service;

use Harproject\AppBundle\Tests\FixturedWebTestCase;
use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Group;
use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Entity\Task;

class ServiceTaskTest extends FixturedWebTestCase{
    
    public function testAddTask(){
        $this->group= new Group();
        $this->group->setLabel( "test" );
        $this->em->persist($this->group);
        
        $this->author = new Member();
        $this->author->setGroup( $this->group );
        $this->author->setProject( $this->project );
        $this->author->setUser( $this->user );
        $this->em->persist($this->author);        
        
        $this->em->flush();
        
        $taskService    = $this->container->get("harproject_app.task");
        $task           = $taskService->addTask( $this->project, $this->author, "testTask" );
        $this->assertTrue($task instanceof Task);
        
        $createdTask = $this->em->getRepository("HarprojectAppBundle:Task")->findOneBy(array(
           "id" =>  $task->getId()
        ));
        
        $this->assertTrue(!is_null($createdTask));
        $this->assertTrue($createdTask instanceof Task);        
        
        
        $taskService->deleteTask($task);
    }
        
}