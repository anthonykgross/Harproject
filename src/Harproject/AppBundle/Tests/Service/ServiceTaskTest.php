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
        
        $this->user = $this->container->get("harproject_app.user")->addUser($userEMail, "test");
        
        $this->creator = new Member();
        $this->creator->setGroup( $this->group );
        $this->creator->setProject( $this->project );
        $this->creator->setUser( $this->user );
        
        $this->em->persist( $this->user );
        $this->em->persist( $this->group );
        $this->em->persist( $this->project );
        $this->em->persist( $this->creator );
        
        $this->em->flush();
    }
     
    protected function tearDown(){
        
        
        
        //$this->em->remove( $this->task );
        $this->em->remove( $this->creator );
        $this->em->remove( $this->user );
        $this->em->remove( $this->group );
        $this->em->remove( $this->project );
        $this->em->flush();
    }
    
    public function testAddTask(){
        $taskService = $this->container->get("harproject_app.task");
        $task = $taskService->addTask( $this->project, $this->creator, "testTask" );
        $this->assertTrue($task instanceof Task);
        /*
        $this->user = $this->em->getRepository("HarprojectAppBundle:Task")->findOneBy(array(
           "email" =>  $email
        ));
        
        $this->assertTrue(!is_null($this->user));
        $this->assertTrue(($this->user instanceof User));
        
        $this->assertTrue((strlen($this->user->getApiKey())==32));
        $this->assertTrue((strlen($this->user->getApiSecret())==32));
        
        $this->setExpectedException('Exception');
        $this->container->get("harproject_app.user")->addUser($email, "test");*/
        
        $taskService->deleteTask( $task );
    }
    
}