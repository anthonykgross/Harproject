<?php
/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
namespace Harproject\AppBundle\Service;
use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Entity\User;
use Harproject\AppBundle\Exception\Http\AccessDeniedException;

class ServiceProject {
    
    private $em;
    private $container;
    
    public function __construct($container) {
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    /**
     * Set into User session de project_id if it's a member.
     * @param User $user
     * @param Project $project
     * @return Member[]
     * @throws AccessDeniedException
     */
    public function chooseProject(User $user, Project $project){
        $members = $this->em->getRepository("HarprojectAppBundle:Member")->findBy(array(
            "user"      => $user,
            "project"   => $project
        ));
        
        if(count($members)==0){
            throw new AccessDeniedException();
        }
        
        $session = $this->container->get('session');
        $session->set('project_id', $project->getId());
        
        return $members;
    }
    
    /**
     * Unset into User session the project_id.
     */
    public function resetSession(){
        $session = $this->container->get('session');
        $session->set('project_id', null);
    }
}