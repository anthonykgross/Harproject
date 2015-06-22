<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Harproject\AppBundle\Entity\Group;
use Harproject\AppBundle\Tests\FixturedWebTestCase;

class ServiceGroupTest extends FixturedWebTestCase{
    
    public function testCreateGroup(){
        $roles   = array(
            "MEMBER_VIEW",
            "TICKET_VIEW",
            "TICKET_ADD",
            "TICKET_EDIT",
            "TASK_VIEW",
            "STATUS_VIEW",
            "TIMETRACKER_VIEW",
        );
        $group = $this->container->get("harproject_app.group")->createGroup("group", $roles);
        $this->assertTrue($group instanceof Group);
        $this->assertTrue(count($group->getRoles())==count($roles));
        
        $roles   = array(
            "MEMBER_VIEWqsdqsdqsd",//FAKE ROLE
            "MEMBER_VIEW",
            "TICKET_VIEW",
            "TICKET_ADD",
            "TICKET_EDIT",
            "TASK_VIEW",
            "STATUS_VIEW",
            "TIMETRACKER_VIEW",
        );
        $group = $this->container->get("harproject_app.group")->createGroup("group", $roles);
        $this->assertTrue($group instanceof Group);
        $this->assertTrue(count($group->getRoles())==count($roles)-1);
    }
}