<?php
namespace Harproject\AppBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Group;
use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Entity\Task;
use Harproject\AppBundle\Exception\Exception;

class ServiceTaskTest extends WebTestCase{

    private $em;
    private $container;
    private $client;
    
    private $project;
    private $creator;
    private $group;
    private $user;
    
    public function __construct(){
        $this->client       = static::createClient();
        $this->container    = $this->client->getContainer();
        $this->em           = $this->container->get('doctrine')->getManager();
    }
       
    protected function setUp(){
        
        $userEMail = "taskUser";
                     
        
        $this->project = new Project();
        
        $this->group= new Group();
        $this->group->setLabel( "test" );
        
        $this->user = $this->em->getRepository("HarprojectAppBundle:User")->findOneBy(array(
            "email" => $userEMail
        ));
        if( $this->user == NULL )
            $this->user = $this->container->get("harproject_app.user")->addUser($userEMail, "test");
        
        $this->author = new Member();
        $this->author->setGroup( $this->group );
        $this->author->setProject( $this->project );
        $this->author->setUser( $this->user );
        
        $this->em->persist( $this->user );
        $this->em->persist( $this->group );
        $this->em->persist( $this->project );
        $this->em->persist( $this->author );
        
        $this->em->flush();
    }
     
    protected function tearDown(){
       
        //$this->em->remove( $this->task );
        $this->em->remove( $this->author );
        $this->em->remove( $this->user );
        $this->em->remove( $this->group );
        $this->em->remove( $this->project );
        $this->em->flush();
    }
    
    public function testAddTask(){
        $taskService = $this->container->get("harproject_app.task");
        $task = $taskService->addTask( $this->project, $this->author, "testTask" );
        $this->assertTrue($task instanceof Task);
        
        $createdTask = $this->em->getRepository("HarprojectAppBundle:Task")->findOneBy(array(
           "id" =>  $task->getId()
        ));
        
        $this->assertTrue(!is_null($createdTask));
        $this->assertTrue($createdTask instanceof Task);        
        
        
        $taskService->deleteTask( $task );
        
        
    }
        
}