<?php
namespace Harproject\AppBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Role;
use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Entity\Task;
use Harproject\AppBundle\Exception\Exception;

class ServiceTaskTest extends WebTestCase{

    private $em;
    private $container;
    private $client;
    
    private $project;
    private $creator;
    private $task;
    
    public function __construct(){
        $this->client       = static::createClient();
        $this->container    = $this->client->getContainer();
        $this->em           = $this->container->get('doctrine')->getManager();
    }
       
    protected function setUp(){
        
        $userEMail = "taskUSer";
        
        $user = $this->em->getRepository("HarprojectAppBundle:User")->findOneBy(array(
            "email" => $userEMail
        ));

        if( $user ) {
            $this->container->get("harproject_app.user")->deleteUser( $user );
        }
        
        $this->project = new Project();
        $this->creator = new Member();
        
        $role = new Role();
        
        $email = "taskUSer";
        $user = $this->container->get("harproject_app.user")->addUser($email, "test");
        
        $role->setLabel( "test" );
        $this->creator->setRole( $role );
        $this->creator->setProject( $this->project );
        $this->creator->setUser( $user );
        
        $this->em->persist( $user );
        $this->em->persist( $role );
        $this->em->persist( $this->project );
        $this->em->persist( $this->creator );
        
        $this->em->flush();
    }
     
    protected function tearDown(){
    }
    
    public function testAddTask(){
        
        $this->task = $this->container->get("harproject_app.task")->addTask( $this->project, $this->creator, "testTask" );
        $this->assertTrue($this->task instanceof Task);
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
    }
    
}