<?php

namespace Harproject\AppBundle\Service;
use Harproject\AppBundle\Entity\Group;

class ServiceGroup {
    
    private $em;
    private $container;
    
    public function __construct($container) {
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    public function initDefaultGroup(){
        $roles      = Group::$basic_roles;
        
        $developer  = $roles;
        $customer   = array(
            "PROJECT_VIEW",
            "MEMBER_VIEW",
            "TICKET_VIEW",
            "TICKET_ADD",
            "TICKET_EDIT",
            "TASK_VIEW",
            "STATUS_VIEW",
            "TIMETRACKER_VIEW",
        );
        
        $developer_group     = new Group();
        $developer_group->setLabel("Developer")->setRoles($developer);
        $customer_group      = new Group();
        $customer_group->setLabel("Customer")->setRoles($customer);
        
        $this->em->persist($developer_group);
        $this->em->persist($customer_group);
        $this->em->flush();
    }
}