<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Tests\Repository;

use Harproject\AppBundle\Entity\Group;
use Harproject\AppBundle\Tests\FixturedWebTestCase;

class ProjectTest extends FixturedWebTestCase{
    
    public function testFindProjects(){
        $group1 = new Group();
        $group1->setLabel("group1")->setRoles(Group::$basic_roles);
        
        $group2 = new Group();
        $group2->setLabel("group2")->setRoles(Group::$basic_roles);
        
        $this->em->persist($group1);
        $this->em->persist($group2);
        $this->em->flush();
        
        $member1 = $this->member;
        $member2 = $this->container->get("harproject_app.user")->addMember($this->user, $this->project, $group1);
        $member3 = $this->container->get("harproject_app.user")->addMember($this->user, $this->project, $group2);
        
        $projects = $this->em->getRepository("HarprojectAppBundle:Project")->findProjects($this->user);
        $this->assertTrue(count($projects)==1);
    }
}