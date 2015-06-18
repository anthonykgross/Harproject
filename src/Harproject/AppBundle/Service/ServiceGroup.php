<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
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
    
    /**
     * Create a group
     * @param String $label
     * @param array $roles
     * @return Group
     */
    public function createGroup($label, Array $roles){
        $valid_roles = array();
        
        foreach($roles as $r){
            if(in_array($r, Group::$basic_roles)){
                $valid_roles[] = $r;
            }
        }
        
        $group = new Group();
        $group->setLabel($label)->setRoles($valid_roles);
        $this->em->persist($group);
        $this->em->flush();
        return $group;
    }
    
    /**
     * Delete a group
     * @param String $label
     * @param array $roles
     * @return Group
     */
    public function deleteGroup(Group $group){
        $group->setDeletedAt(new \DateTime());
        $this->em->persist($group);
        $this->em->flush();
        return $group;
    }
}