<?php 

namespace Harproject\AppBundle\Twig;

use Harproject\AppBundle\Entity\Task;

/**
 * @author Anthony K GROSS <anthony.k.gross@gmail.com>
 */
class TaskExtension extends \Twig_Extension
{
    private $em;
    
    public function __construct($container){
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    public function getFilters(){
        return array(
            'getSelecter' => new \Twig_Filter_Method($this, 'getSelecterFilter')
        );
    }

    public function getName(){
        return 'task_extension';
    }

    public function getSelecterFilter(Task $task){
        return $this->container->get("harproject_app.task")->getSelecter($task);
    }
}

?>