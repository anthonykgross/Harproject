<?php
namespace Harproject\AppBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Harproject\AppBundle\Entity\Tag;

class ServiceTagTest extends WebTestCase{

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
        $tags = $this->em->getRepository("HarprojectAppBundle:Tag")->findAll();
        
        foreach($tags as $t){
            $this->em->remove($t);
        }
        $this->em->flush();
    }
    
    public function testGetOrCreateTag(){
        $tag = $this->container->get("harproject_app.tag")->getOrCreate("un_tag");
        $this->assertTrue(!is_null($tag));
        
        $tag = $this->container->get("harproject_app.tag")->getOrCreate("uN_tAg");
        $this->assertTrue(!is_null($tag));
        
        $tags = $this->em->getRepository("HarprojectAppBundle:Tag")->findAll();
        $this->assertTrue(count($tags)==1);
        
        $tag = $this->container->get("harproject_app.tag")->getOrCreate("uN_tAgsss");
        $this->assertTrue(!is_null($tag));
        
        $tags = $this->em->getRepository("HarprojectAppBundle:Tag")->findAll();
        $this->assertTrue(count($tags)==2);
    }
    
    public function testAssignTag(){
        $obj = $this->container->get("harproject_app.tag")->assignTag("un_tag");
        $this->assertTrue(is_null($obj));
        
        $obj = $this->container->get("harproject_app.tag")->assignTag("un_tag", "okoko");
        $this->assertTrue(is_null($obj));
        
        $tags = $this->em->getRepository("HarprojectAppBundle:Tag")->findAll();
        $this->assertTrue(count($tags)==0);
        
        $tag = $this->container->get("harproject_app.tag")->getOrCreate("un_tag");
        $this->assertTrue(!is_null($tag));
        
        $tags = $this->em->getRepository("HarprojectAppBundle:Tag")->findAll();
        $this->assertTrue(count($tags)==1);
        
        $obj = $this->container->get("harproject_app.tag")->assignTag($tag);
        $this->assertTrue(is_null($obj));
        
        $obj = $this->container->get("harproject_app.tag")->assignTag($tag, "okoko");
        $this->assertTrue(is_null($obj));
        
        $obj = $this->container->get("harproject_app.tag")->assignTag($tag, $tag);
        $this->assertTrue(is_null($obj));
        
        /**
         * @todo Faire les tests de ASSIGNTAG  avec un parametre TAG, TASK, TICKET ET TIMETRACKER
         */
    }
    
    public function testRemoveTag(){
        /**
         * @todo Faire les tests de REMOVETAG  avec un parametre TAG, TASK, TICKET ET TIMETRACKER
         */
    }
}