<?php

namespace Harproject\AppBundle\Service;

use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Service\Role;
use Harproject\AppBundle\Entity\Member;

use Harproject\AppBundle\Exception\Exception;
use Symfony\Component\Security\Core\Util\SecureRandom;

class ServiceUser {
    
    private $em;
    private $container;
    
    public function __construct($container) {
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    /**
     * Register a new user
     * @param type $email
     * @param type $password
     * @throws Exception
     * @return User
     */
    public function addUser($email, $password){
        $user = $this->em->getRepository("HarprojectAppBundle:User")->findOneBy(array(
            "email" => $email
        ));
        
        if($user){
            throw new Exception("This user is already registered");
        }
        
        $user = new User();
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setUsername($email);
        $user->setApiKey("apiKey");
        $user->setApiSecret("apiSecret");
        $user->setEnabled(True);
        $this->em->persist($user);
        $this->em->flush();
        
        $this->resetApiIds($user);
        
        return $user;
    }
    
    /**
     * Reset all API identifiers
     * @param User $user
     * @return User
     */
    public function resetApiIds(User $user){
        $generator      = new SecureRandom();
        $api_key        = bin2hex($generator->nextBytes(16));
        $api_secret     = bin2hex($generator->nextBytes(16));

        $user->setApiKey($api_key);
        $user->setApiSecret($api_secret);
        $this->em->persist($user);
        $this->em->flush();
        
        return $user;
    }
    
    /**
     * Return True if the User has Role for the project otherwise False
     * @param User $user
     * @param Project $project
     * @param Role $role
     * @return boolean
     */
    public function hasRole(User $user, Project $project, Role $role){
        return ($this->getMember($user, $project, $role));
    }
    
    /**
     * Return the mêmber if the User has Role for the project otherwise NULL
     * @param User $user
     * @param Project $project
     * @param Role $role
     * @return Member or NULL
     */
    public function getMember(User $user, Project $project, Role $role){
        return $this->em->getRepository("HarprojectAppBundle:Member")->findOneBy(array(
            "user"      => $user,
            "role"      => $role,
            "project"   => $project
        ));
    }
    
    /**
     * Add an User to the Project with a given Role
     * @param User $user
     * @param Project $project
     * @param Role $role
     * @throws Exception
     * @return Member
     */
    public function addMember(User $user, Project $project, Role $role){
        if($this->getMember($user, $project, $role)){
            throw new Exception("This user is already member of project");
        }
        
        $member = new Member();
        $member->setRole($role)->setUser($user)->setProject($project);
        $this->em->persist($member);
        $this->em->flush();
        
        return $member;
    }
    
    /**
     * Update the role for a member
     * @param Member $member
     * @param Role $role
     * @throws Exception
     * @return Member
     */
    public function updateMember(Member $member, Role $role){
        if($this->getMember($member->getUser(), $member->getProject(), $role)){
            throw new Exception("This user has already role for the project");
        }
        
        $member->setRole($role)->setUpdatedAt(new \DateTime());
        $this->em->persist($member);
        $this->em->flush();
        
        return $member;
    }
}