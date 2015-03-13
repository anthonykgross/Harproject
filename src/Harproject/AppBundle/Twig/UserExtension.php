<?php 

namespace Harproject\AppBundle\Twig;

use Harproject\AppBundle\Entity\Member;

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
        );
    }

    public function hasRoleFilter(Member $member, $role){
        return $this->container->get('harproject_app.user')->hasRole($member, $role);
    }

    public function getName(){
        return 'hasrole_extension';
    }
}

?>