<?php

namespace Harproject\OverrideBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HarprojectOverrideBundle:Default:index.html.twig', array('name' => $name));
    }
}
