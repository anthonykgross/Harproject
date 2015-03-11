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
                ->setName('user:create')
                ->setDescription('Create a new user')
                ->addArgument('email', InputArgument::REQUIRED, 'User email')
                ->addArgument('password', InputArgument::REQUIRED, 'User password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $newUser = new User();

        $newUser->setEmail($email);
        $newUser->setPlainPassword($password);
        $newUser->setUsername($email);
        $newUser->setApiKey("apiKey");
        $newUser->setApiSecret("apiSecret");
        
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        
        $em->persist( $newUser );
        $em->flush();
    }

}
