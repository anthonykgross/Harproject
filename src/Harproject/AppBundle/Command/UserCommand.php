<?php

namespace Harproject\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Harproject\AppBundle\Entity\User;

class UserCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('harproject:user:create')
                ->setDescription('Create a new user')
                ->addArgument('email', InputArgument::REQUIRED, 'User email')
                ->addArgument('password', InputArgument::REQUIRED, 'User password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->getContainer()->get('harproject_app.user')->addUser($input->getArgument('email'), $input->getArgument('password'));
    }

}
