<?php

namespace Harproject\AppBundle\Controller\Dashboard;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Harproject\AppBundle\Entity\Project;
use Harproject\AppBundle\Form\ProjectType;

/**
 * Project controller.
 */
class ProjectController extends Controller
{

    /**
     * Let the user choose it project
     * @param Integer $id
     */
    public function chooseAction($id){
        $em         = $this->getDoctrine()->getManager();
        $user       = $this->get('security.context')->getToken()->getUser();
        $project    = $em->getRepository('HarprojectAppBundle:Project')->find($id);
        
        $this->get("harproject_app.project")->chooseProject($user, $project);
        
        return $this->redirect($this->generateUrl('harproject_app_dashboard_index'));
    }
}
