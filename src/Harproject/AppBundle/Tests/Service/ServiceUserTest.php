<?php
namespace Harproject\AppBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Harproject\AppBundle\Entity\User;

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
        $this->container->get("harproject_app.user")->addUser("test@test.fr", "test");
    }
    
    public function testResetApiIds(){
        $email = "test@test.fr";
        
        $user = $this->container->get("harproject_app.user")->addUser("test@test.fr", "test");
        $this->assertTrue($user instanceof User);
        
        $api_key        = $user->getApiKey();
        $api_secret     = $user->getApiSecret();
        
        $this->user = $this->container->get("harproject_app.user")->resetApiIds($user);
        $this->assertTrue((strlen($this->user->getApiKey())==32));
        $this->assertTrue((strlen($this->user->getApiSecret())==32));
        
        $this->assertTrue($this->user->getApiKey()!==$api_key);
        $this->assertTrue($this->user->getApiSecret()!==$api_secret);
    }
}