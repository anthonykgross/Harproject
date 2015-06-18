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
        $user = $this->em->getRepository("HarprojectAppBundle:User")->findOneBy(array(
            "email" => $email
        ));

        if ($user) {
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
     * Return the mêmber if the User has a group for the project otherwise NULL
     * @param User $user
     * @param Project $project
     * @return Member or NULL
     */
    public function getMember(User $user, Project $project) {
        return $this->em->getRepository("HarprojectAppBundle:Member")->findOneBy(array(
            "user"          => $user,
            "project"       => $project, 
            "deleted_at"    => null
        ));
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
        if($this->getMember($user, $project)){
            throw new Exception("This user is already member of project");
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
     * @param Group $group
     * @throws Exception
     * @return Member
     */

    public function updateMember(Member $member, Group $group){
        $member->setGroup($group)->setUpdatedAt(new \DateTime());
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
