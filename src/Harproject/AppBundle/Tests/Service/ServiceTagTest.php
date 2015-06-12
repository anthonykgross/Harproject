<?php
namespace Harproject\AppBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Harproject\AppBundle\Entity\Tag;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Task;
use Harproject\AppBundle\Tests\FixturedWebTestCase;
use Harproject\AppBundle\Entity\TaskHasTag;

class ServiceTagTest extends FixturedWebTestCase{
    
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
        
        $tasks = $this->project->getTasks();
        $task1 = $tasks[0];
        
        //Add a tag to Task
        $obj = $this->container->get("harproject_app.tag")->assignTag($tag, $task1);
        $this->assertTrue(!is_null($obj));
        $this->assertTrue($obj instanceof TaskHasTag);
        
        $this->em->refresh($task1);
        $this->assertTrue(count($task1->getTaskHasTags())==1);
        
        //Add a tag to Ticket
        
        //Add a tag to TimeTracker
        
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