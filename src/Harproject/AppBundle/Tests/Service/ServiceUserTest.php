<?php
namespace Harproject\AppBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Role;
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
    
     protected function tearDown(){
        $email = "test@test.fr";
        $this->user = $this->em->getRepository("HarprojectAppBundle:User")->findOneBy(array(
           "email" =>  $email
        ));
        
        if($this->user){
            $this->em->remove($this->user);
            $this->em->flush();
        }
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
        
        $roles = $this->em->getRepository("HarprojectAppBundle:Role")->findAll();
        if(count($roles)==0){
            $this->container->get("harproject_app.role")->initDefaultRole();
        }
        
        $role_customer = $this->em->getRepository("HarprojectAppBundle:Role")->findOneBy(array(
            "label" => "Customer"
        ));
        
        $member1 = $this->container->get("harproject_app.user")->addMember($this->user, $project, $role_customer);
        $this->assertTrue(($member1 instanceof Member));
        
        try{
            $this->container->get("harproject_app.user")->addMember($this->user, $project, $role_customer);
            $this->assertFalse(False);
        }
        catch(Exception $e){
            $this->em->remove($member1);
            $this->em->flush();
        }
    }
    
    public function testHasRole(){
        $email = "test@test.fr";
        $this->user = $this->container->get("harproject_app.user")->addUser($email, "test");
        
        $project    = new Project();
        $this->em->persist($project);
        $this->em->flush();
        
        $roles = $this->em->getRepository("HarprojectAppBundle:Role")->findAll();
        if(count($roles)==0){
            $this->container->get("harproject_app.role")->initDefaultRole();
        }
        
        $role_customer = $this->em->getRepository("HarprojectAppBundle:Role")->findOneBy(array(
            "label" => "Customer"
        ));
        $role_developer = $this->em->getRepository("HarprojectAppBundle:Role")->findOneBy(array(
            "label" => "Developer"
        ));
        
        $member1 = $this->container->get("harproject_app.user")->addMember($this->user, $project, $role_customer);
        $this->assertTrue(($member1 instanceof Member));
        
        $hasRoleCustomer  = $this->container->get("harproject_app.user")->hasRole($member1, $role_customer);
        $hasRoleDeveloper = $this->container->get("harproject_app.user")->hasRole($member1, $role_developer);
        $this->assertTrue($hasRoleCustomer);
        $this->assertTrue(!$hasRoleDeveloper);
        
        $this->em->remove($member1);
        $this->em->flush();
    }
    
    public function testUpdateMember(){
        $email = "test@test.fr";
        $this->user = $this->container->get("harproject_app.user")->addUser($email, "test");
        
        $project    = new Project();
        $this->em->persist($project);
        $this->em->flush();
        
        $roles = $this->em->getRepository("HarprojectAppBundle:Role")->findAll();
        if(count($roles)==0){
            $this->container->get("harproject_app.role")->initDefaultRole();
        }
        
        $role_customer = $this->em->getRepository("HarprojectAppBundle:Role")->findOneBy(array(
            "label" => "Customer"
        ));
        $role_developer = $this->em->getRepository("HarprojectAppBundle:Role")->findOneBy(array(
            "label" => "Developer"
        ));
        
        $member1 = $this->container->get("harproject_app.user")->addMember($this->user, $project, $role_customer);
        $this->assertTrue(($member1 instanceof Member));
        
        $hasRoleCustomer  = $this->container->get("harproject_app.user")->hasRole($member1, $role_customer);
        $hasRoleDeveloper = $this->container->get("harproject_app.user")->hasRole($member1, $role_developer);
        $this->assertTrue($hasRoleCustomer);
        $this->assertTrue(!$hasRoleDeveloper);
        
        $member1 = $this->container->get("harproject_app.user")->updateMember($member1, $role_developer);
        $this->assertTrue(($member1 instanceof Member));
        
        $hasRoleCustomer  = $this->container->get("harproject_app.user")->hasRole($member1, $role_customer);
        $hasRoleDeveloper = $this->container->get("harproject_app.user")->hasRole($member1, $role_developer);
        $this->assertTrue(!$hasRoleCustomer);
        $this->assertTrue($hasRoleDeveloper);
        
        $this->em->remove($member1);
        $this->em->flush();
    }
}