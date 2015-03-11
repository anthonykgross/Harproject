<?php

namespace Harproject\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Harproject\AppBundle\Entity\Role;

class RoleCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('harproject:role:create')
                ->setDescription('Create a roles')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em         = $this->getContainer()->get('doctrine')->getEntityManager();
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
        
        $em->persist($developer_role);
        $em->persist($customer_role);
        $em->flush();
    }

}
