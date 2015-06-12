<?php

/**
 * This Class allows to create basic data to run unit tests and delete them
 *
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Group;
use Harproject\AppBundle\Entity\Member;

abstract class FixturedWebTestCase  extends WebTestCase{
    
    protected $em;
    protected $container;
    protected $client;
    
    protected $user;
    protected $project;
    
    public function __construct(){
        $this->client       = static::createClient();
        $this->container    = $this->client->getContainer();
        $this->em           = $this->container->get('doctrine')->getManager();
    }
    
    protected function setUp(){
        $this->project  = new Project();
        $this->em->persist($this->project);
        $this->user     = $this->container->get("harproject_app.user")->addUser("user@example.org", "password");
        
        $this->container->get("harproject_app.group")->initDefaultGroup();
        $group_developer = $this->em->getRepository("HarprojectAppBundle:Group")->findOneBy(array(
            "label" => "Developer"
        ));
        
        $member = $this->container->get("harproject_app.user")->addMember($this->user, $this->project, $group_developer);
         
        $taskService = $this->container->get("harproject_app.task");
        $taskService->addTask($this->project, $member, "Task1");
        $taskService->addTask($this->project, $member, "Task2");
        
        $this->em->refresh($this->project);
        $this->em->flush();
    }
    
    protected function tearDown(){
        $taskHasTags = $this->em->getRepository("HarprojectAppBundle:TaskHasTag")->findAll();
        foreach($taskHasTags as $t){
            $this->em->remove($t);
        }
        
        $tags = $this->em->getRepository("HarprojectAppBundle:Tag")->findAll();
        foreach($tags as $t){
            $this->em->remove($t);
        }
        
        $projects = $this->em->getRepository("HarprojectAppBundle:Project")->findAll();
        foreach($projects as $p){
            $this->em->remove($p);
        }
        
        $tasks = $this->em->getRepository("HarprojectAppBundle:Task")->findAll();
        foreach($tasks as $t){
            $this->em->remove($t);
        }
        
        $members = $this->em->getRepository("HarprojectAppBundle:Member")->findAll();
        foreach($members as $m){
            $this->em->remove($m);
        }
        
        $users = $this->em->getRepository("HarprojectAppBundle:User")->findAll();
        foreach($users as $u){
            $this->em->remove($u);
        }
        
        $groups = $this->em->getRepository("HarprojectAppBundle:Group")->findAll();
        foreach($groups as $g){
            $this->em->remove($g);
        }
        
        $this->em->flush();
    }
}
