<?php

namespace Onic\FlightInventoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OnicFlightInventoryBundle:Default:index.html.twig');
    }
}
