<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Tests\Repository;

use Harproject\AppBundle\Entity\Group;
use Harproject\AppBundle\Entity\Task;
use Harproject\AppBundle\Tests\FixturedWebTestCase;

class TaskTest extends FixturedWebTestCase{
    
    public function testFindTasks(){
        $group1 = new Group();
        $group1->setLabel("group1")->setRoles(Group::$basic_roles);
        
        $group2 = new Group();
        $group2->setLabel("group2")->setRoles(Group::$basic_roles);
        
        $this->em->persist($group1);
        $this->em->persist($group2);
        $this->em->flush();
        
        $task3 = new Task();
        $task4 = new Task();
        
        $task3->setAuthor($this->member)->setEstimatedTime(0)->setProject($this->project)->setSpentTime(0)->setName("task3");
        $task4->setAuthor($this->member)->setEstimatedTime(0)->setProject($this->project)->setSpentTime(0)->setName("task4");
        
        $this->em->persist($task3);
        $this->em->persist($task4);
        $this->em->flush();
        
        $member1 = $this->member;
        $member2 = $this->container->get("harproject_app.user")->addMember($this->user, $this->project, $group1);
        $member3 = $this->container->get("harproject_app.user")->addMember($this->user, $this->project, $group2);
        
        $tasks = $this->em->getRepository("HarprojectAppBundle:Task")->findTasks($member1->getUser());
        //$this->assertTrue(count($tasks)==4);
    }
}