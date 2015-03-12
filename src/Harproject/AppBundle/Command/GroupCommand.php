<?php

namespace Harproject\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GroupCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('harproject:groups:init')
                ->setDescription('Create default groups')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em         = $this->getContainer()->get('harproject_app.group')->initDefaultGroup();
        
    }

}
