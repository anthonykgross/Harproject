<?php

namespace Harproject\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function homepageAction()
    {
        return $this->redirect($this->generateUrl('harproject_app_dashboard_index'));
    }
    
    public function indexAction()
    {
        return $this->render('HarprojectAppBundle:Dashboard:index.html.twig');
    }
}
