<?php

namespace Onic\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OnicUserBundle:Default:index.html.twig');
    }
}
