<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */

namespace Harproject\AppBundle\Service;

use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\Group;
use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Exception\Exception;
use Symfony\Component\Security\Core\Util\SecureRandom;


class ServiceUser {

    private $em;
    private $container;

    public function __construct($container) {
        $this->container = $container;
        $this->em = $container->get('doctrine')->getManager();
    }

    /**
     * Register a new user
     * @param type $email
     * @param type $password
     * @throws Exception
     * @return User
     */
    public function addUser($email, $password) {
        $user = $this->em->getRepository("HarprojectAppBundle:User")->rawFindOneBy(array(
            "email" => $email
        ));

        // If an user with this email exist AND if this user is not deleted 
        if ($user && ! $user->isDeleted() ) {
            throw new Exception("This user is already registered");
        }

        if( ! $user ) {
            $user = new User();
        }

        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setUsername($email);
        $user->setApiKey("apiKey");
        $user->setApiSecret("apiSecret");
        $user->setEnabled(True);
        $user->setDeletedAt(null);
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
    public function resetApiIds(User $user) {
        $generator = new SecureRandom();
        $api_key = bin2hex($generator->nextBytes(16));
        $api_secret = bin2hex($generator->nextBytes(16));

        $user->setApiKey($api_key);
        $user->setApiSecret($api_secret);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * Return True if the Member has Role for the project otherwise False
     * @param Member $member
     * @param String $role
     * @return boolean
     */
    public function hasRole(Member $member, $role){
        return (in_array($role, $member->getGroup()->getRoles()) && is_null($member->getDeletedAt()));
    }

    /**
     * Return True if the User has Role for the project otherwise False
     * @param User $user
     * @param String $role
     * @return boolean
     */
    public function userHasRole(User $user, $role, $project_id){
        $bOk = false;
        
        foreach($user->getMembers() as $member){
            if(!$bOk && $member->getProject()->getId() == $project_id){
                $bOk = $this->hasRole($member, $role);
            }
        }
        return $bOk;
    }
    
    /**
     * Return True if the User is a Member for the project
     * @param User $user
     * @param Project $project
     * @return Boolean
     */
    public function isMember(User $user, Project $project){
        return (count($this->getMembers($user, $project))>0);
    }
    
    /**
     * Return the mêmbers if the User has groups for the project
     * @param User $user
     * @param Project $project
     * @return Member[]
     */
    public function getMembers(User $user, Project $project, Group $group = null) {
        $params = array(
            "user"          => $user,
            "project"       => $project,
            "deleted_at"    => null
        );
        
        if(!is_null($group)){
            $params['group'] = $group;
        }
        return $this->em->getRepository("HarprojectAppBundle:Member")->findBy($params);
    }

    /**
     * Add an User to the Project with a given Role
     * @param User $user
     * @param Project $project
     * @param Group $group
     * @throws Exception
     * @return Member
     */
    public function addMember(User $user, Project $project, Group $group){
        if(count($this->getMembers($user, $project, $group)) > 1){
            throw new Exception("This user is already member of project with the group.");
        }

        $member = new Member();
        $member->setGroup($group)->setUser($user)->setProject($project);
        $this->em->persist($member);
        $this->em->flush();

        return $member;
    }

    /**
     * Update the group for a member
     * @param Member $member
     * @throws Exception
     * @return Member
     */

    public function updateMember(Member $member){
        $member->setUpdatedAt(new \DateTime());
        $this->em->persist($member);
        $this->em->flush();

        return $member;
    }

    /**
     * Delete a member
     * @param Member $member
     * @return Member
     */
    public function deleteMember(Member $member) {
        $member->setDeletedAt(new \DateTime());
        $this->em->persist($member);
        $this->em->flush();
        
        return $member;
    }
    
}
