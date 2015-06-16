<?php
namespace Harproject\AppBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Group;
use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Exception\Exception;

class ServiceUserTest extends WebTestCase{

    private $em;
    private $container;
    private $client;
    
    private $user;
    
    public function __construct(){
        $this->client       = static::createClient();
        $this->container    = $this->client->getContainer();
        $this->em           = $this->container->get('doctrine')->getManager();
    }
    
    protected function setUp(){
        $this->container->get("harproject_app.group")->initDefaultGroup();
    }
    
    protected function tearDown(){
        $email = "test@test.fr";
        $this->user = $this->em->getRepository("HarprojectAppBundle:User")->findOneBy(array(
           "email" =>  $email
        ));
        
        if($this->user){
            $this->em->remove($this->user);
            $this->em->flush();
        }
        
        $groups = $this->em->getRepository("HarprojectAppBundle:Group")->findAll();
        foreach($groups as $g){
            $this->em->remove($g);
        }
        $this->em->flush();
    }
    
    public function testAddUser(){
        $email = "test@test.fr";

        $this->user = $this->container->get("harproject_app.user")->addUser("test@test.fr", "test");
        $this->assertTrue($this->user instanceof User);
        
        $this->user = $this->em->getRepository("HarprojectAppBundle:User")->findOneBy(array(
           "email" =>  $email
        ));
        
        $this->assertTrue(!is_null($this->user));
        $this->assertTrue(($this->user instanceof User));
        
        $this->assertTrue((strlen($this->user->getApiKey())==32));
        $this->assertTrue((strlen($this->user->getApiSecret())==32));
        
        $this->setExpectedException('Exception');
        $this->container->get("harproject_app.user")->addUser($email, "test");
    }
    
    public function testResetApiIds(){
        $email = "test@test.fr";
        
        $user = $this->container->get("harproject_app.user")->addUser($email, "test");
        $this->assertTrue($user instanceof User);
        
        $api_key        = $user->getApiKey();
        $api_secret     = $user->getApiSecret();
        
        $this->user = $this->container->get("harproject_app.user")->resetApiIds($user);
        $this->assertTrue((strlen($this->user->getApiKey())==32));
        $this->assertTrue((strlen($this->user->getApiSecret())==32));
        
        $this->assertTrue($this->user->getApiKey()!==$api_key);
        $this->assertTrue($this->user->getApiSecret()!==$api_secret);
    }
    
    public function testAddMember(){
        $email = "test@test.fr";
        $this->user = $this->container->get("harproject_app.user")->addUser($email, "test");
        
        $project    = new Project();
        $this->em->persist($project);
        $this->em->flush();

        $group_customer = $this->em->getRepository("HarprojectAppBundle:Group")->findOneBy(array(
            "label" => "Customer"
        ));
        
        $member1 = $this->container->get("harproject_app.user")->addMember($this->user, $project, $group_customer);
        $this->assertTrue(($member1 instanceof Member));
        
        try{
            $this->container->get("harproject_app.user")->addMember($this->user, $project, $group_customer);
        }
        catch(Exception $e){
            
        }
        $this->em->remove($member1);
        $this->em->remove($project);
        $this->em->flush();
    }
    
    public function testHasRole(){
        $email = "test@test.fr";
        $this->user = $this->container->get("harproject_app.user")->addUser($email, "test");
        
        $project    = new Project();
        $this->em->persist($project);
        $this->em->flush();
        
        $groups = $this->em->getRepository("HarprojectAppBundle:Group")->findAll();
        if(count($groups)==0){
            $this->container->get("harproject_app.group")->initDefaultGroup();
        }
        
        $group_customer = $this->em->getRepository("HarprojectAppBundle:Group")->findOneBy(array(
            "label" => "Customer"
        ));
        $group_developer = $this->em->getRepository("HarprojectAppBundle:Group")->findOneBy(array(
            "label" => "Developer"
        ));
        
        $member1 = $this->container->get("harproject_app.user")->addMember($this->user, $project, $group_customer);
        $this->assertTrue(($member1 instanceof Member));
        
        //By default, only the developer can add a project
        $hasRoleProjectAdd  = $this->container->get("harproject_app.user")->hasRole($member1, "MEMBER_ADD");
        $this->assertTrue(!$hasRoleProjectAdd);
        
        $this->em->remove($member1);
        $this->em->remove($project);
        $this->em->flush();
    }
    
    public function testUpdateMember(){
        $email = "test@test.fr";
        $this->user = $this->container->get("harproject_app.user")->addUser($email, "test");
        
        $project    = new Project();
        $this->em->persist($project);
        $this->em->flush();
        
        $groups = $this->em->getRepository("HarprojectAppBundle:Group")->findAll();
        if(count($groups)==0){
            $this->container->get("harproject_app.group")->initDefaultGroup();
        }
        
        $group_customer = $this->em->getRepository("HarprojectAppBundle:Group")->findOneBy(array(
            "label" => "Customer"
        ));
        $group_developer = $this->em->getRepository("HarprojectAppBundle:Group")->findOneBy(array(
            "label" => "Developer"
        ));
        
        $member1 = $this->container->get("harproject_app.user")->addMember($this->user, $project, $group_customer);
        $this->assertTrue(($member1 instanceof Member));
        
        //By default, only the developer can add a project
        $hasRoleProjectAdd  = $this->container->get("harproject_app.user")->hasRole($member1, "MEMBER_ADD");
        $this->assertTrue(!$hasRoleProjectAdd);
        
        $member1 = $this->container->get("harproject_app.user")->updateMember($member1, $group_developer);
        $this->assertTrue(($member1 instanceof Member));
        
        //By default, only the developer can add a project
        $hasRoleProjectAdd  = $this->container->get("harproject_app.user")->hasRole($member1, "MEMBER_ADD");
        $this->assertTrue($hasRoleProjectAdd);
        
        $this->em->remove($member1);
        $this->em->remove($project);
        $this->em->flush();
    }
}