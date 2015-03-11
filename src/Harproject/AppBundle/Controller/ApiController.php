<?php

namespace Harproject\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{
    public function testAction()
    {
        echo("Ca marche");
        exit;
    }
}
