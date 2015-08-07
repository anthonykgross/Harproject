<?php 

namespace Harproject\AppBundle\Twig;

use Harproject\AppBundle\Entity\Member;
use Harproject\AppBundle\Entity\User;

/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
class ProjectExtension extends \Twig_Extension
{
    private $em;
    
    public function __construct($container){
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    public function getFilters(){
        return array(
            'getProject' => new \Twig_Filter_Method($this, 'getProjectFilter')
        );
    }

    public function getName(){
        return 'project_extension';
    }

    public function getProjectFilter($project_id){
        return $this->em->getRepository('HarprojectAppBundle:Project')->find($project_id);
    }
}

?>