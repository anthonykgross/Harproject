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
        $em         = $this->getContainer()->get('harproject_app.role')->initDefaultRole();
        
    }

}
