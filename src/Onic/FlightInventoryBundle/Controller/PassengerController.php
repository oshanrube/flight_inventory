<?php

namespace Onic\FlightInventoryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Onic\FlightInventoryBundle\Entity\FiPassenger;
use Onic\FlightInventoryBundle\Form\FiPassengerType;

/**
 * Passenger controller.
 */
class PassengerController extends Controller
{
    /**
     * Lists all Passenger entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $passengers = $em->getRepository('OnicFlightInventoryBundle:FiPassenger')->findAll();

        return $this->render('OnicFlightInventoryBundle:Passenger:index.html.twig', array(
            'passengers' => $passengers,
        ));
    }

    /**
     * Creates a new Passenger entity.
     */
    public function newAction(Request $request)
    {
        $passenger = new FiPassenger();
        $form    = $this->createForm('Onic\FlightInventoryBundle\Form\FiPassengerType', $passenger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($passenger);
            $em->flush();

            return $this->redirectToRoute('passenger_show', array('id' => $passenger->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Passenger:new.html.twig', array(
            'passenger' => $passenger,
            'form'    => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Passenger entity.
     */
    public function showAction(FiPassenger $passenger)
    {
        $deleteForm = $this->createDeleteForm($passenger);

        return $this->render('OnicFlightInventoryBundle:Passenger:show.html.twig', array(
            'passenger'     => $passenger,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Passenger entity.
     */
    public function editAction(Request $request, FiPassenger $passenger)
    {
        $deleteForm = $this->createDeleteForm($passenger);
        $editForm   = $this->createForm('Onic\FlightInventoryBundle\Form\FiPassengerType', $passenger);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($passenger);
            $em->flush();

            return $this->redirectToRoute('passenger_edit', array('id' => $passenger->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Passenger:edit.html.twig', array(
            'passenger'     => $passenger,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Passenger entity.
     */
    public function deleteAction(Request $request, FiPassenger $passenger)
    {
        $form = $this->createDeleteForm($passenger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($passenger);
            $em->flush();
        }

        return $this->redirectToRoute('passenger_index');
    }

    /**
     * Creates a form to delete a Passenger entity.
     * @param Passenger $passenger The Passenger entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FiPassenger $passenger)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('passenger_delete', array('id' => $passenger->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
