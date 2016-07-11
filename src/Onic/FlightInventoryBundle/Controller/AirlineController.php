<?php

namespace Onic\FlightInventoryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Onic\FlightInventoryBundle\Entity\FiAirline;
use Onic\FlightInventoryBundle\Form\FiAirlineType;

/**
 * Airline controller.
 */
class AirlineController extends Controller
{
    /**
     * Lists all Airline entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $airlines = $em->getRepository('OnicFlightInventoryBundle:FiAirline')->findAll();

        return $this->render('OnicFlightInventoryBundle:Airline:index.html.twig', array(
            'airlines' => $airlines,
        ));
    }

    /**
     * Creates a new Airline entity.
     */
    public function newAction(Request $request)
    {
        $airline = new FiAirline();
        $form    = $this->createForm('Onic\FlightInventoryBundle\Form\FiAirlineType', $airline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($airline);
            $em->flush();

            return $this->redirectToRoute('airline_show', array('id' => $airline->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Airline:new.html.twig', array(
            'airline' => $airline,
            'form'    => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Airline entity.
     */
    public function showAction(FiAirline $airline)
    {
        $deleteForm = $this->createDeleteForm($airline);

        return $this->render('OnicFlightInventoryBundle:Airline:show.html.twig', array(
            'airline'     => $airline,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Airline entity.
     */
    public function editAction(Request $request, FiAirline $airline)
    {
        $deleteForm = $this->createDeleteForm($airline);
        $editForm   = $this->createForm('Onic\FlightInventoryBundle\Form\FiAirlineType', $airline);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($airline);
            $em->flush();

            return $this->redirectToRoute('airline_edit', array('id' => $airline->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Airline:edit.html.twig', array(
            'airline'     => $airline,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Airline entity.
     */
    public function deleteAction(Request $request, FiAirline $airline)
    {
        $form = $this->createDeleteForm($airline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($airline);
            $em->flush();
        }

        return $this->redirectToRoute('airline_index');
    }

    /**
     * Creates a form to delete a Airline entity.
     * @param Airline $airline The Airline entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FiAirline $airline)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('airline_delete', array('id' => $airline->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
