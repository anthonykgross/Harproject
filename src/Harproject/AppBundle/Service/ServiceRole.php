<?php

namespace Harproject\AppBundle\Service;
use Harproject\AppBundle\Entity\Role;

class ServiceRole {
    
    private $em;
    private $container;
    
    public function __construct($container) {
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    public function initDefaultRole(){
        $roles      = Role::$basic_roles;
        
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
        
        $developer_role     = new Role();
        $developer_role->setLabel("Developer")->setRoles($developer);
        $customer_role      = new Role();
        $customer_role->setLabel("Customer")->setRoles($customer);
        
        $this->em->persist($developer_role);
        $this->em->persist($customer_role);
        $this->em->flush();
    }
}