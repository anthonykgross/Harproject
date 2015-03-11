<?php

namespace Harproject\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HarprojectAppBundle:Default:index.html.twig', array('name' => $name));
    }
}
