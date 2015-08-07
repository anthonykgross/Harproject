<?php 

namespace Harproject\AppBundle\Twig;

use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Entity\User;

/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
class UserExtension extends \Twig_Extension
{
    private $em;
    
    public function __construct($container){
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    public function getFilters(){
        return array(
            'hasRole' => new \Twig_Filter_Method($this, 'hasRoleFilter'),
            'findProjects' => new \Twig_Filter_Method($this, 'findProjectsFilter'),
        );
    }

    public function hasRoleFilter(User $user, $role){
        return $this->container->get('harproject_app.user')->userHasRole($user, $role);
    }

    public function getName(){
        return 'user_extension';
    }
    
    public function findProjectsFilter(User $user){
        return $this->em->getRepository('HarprojectAppBundle:Project')->findProjects($user);
    }
}

?>