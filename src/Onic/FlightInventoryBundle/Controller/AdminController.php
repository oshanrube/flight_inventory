<?php

namespace Onic\FlightInventoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('OnicFlightInventoryBundle:Admin:index.html.twig');
    }
}
