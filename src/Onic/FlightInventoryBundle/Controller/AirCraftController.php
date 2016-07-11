<?php

namespace Onic\FlightInventoryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Onic\FlightInventoryBundle\Entity\FiAircraft;
use Onic\FlightInventoryBundle\Form\FiAircraftType;

/**
 * Aircraft controller.
 */
class AircraftController extends Controller
{
    /**
     * Lists all Aircraft entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $aircrafts = $em->getRepository('OnicFlightInventoryBundle:FiAircraft')->findAll();

        return $this->render('OnicFlightInventoryBundle:Aircraft:index.html.twig', array(
            'aircrafts' => $aircrafts,
        ));
    }

    /**
     * Creates a new Aircraft entity.
     */
    public function newAction(Request $request)
    {
        $aircraft = new FiAircraft();
        $form    = $this->createForm('Onic\FlightInventoryBundle\Form\FiAircraftType', $aircraft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aircraft);
            $em->flush();

            return $this->redirectToRoute('aircraft_show', array('id' => $aircraft->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Aircraft:new.html.twig', array(
            'aircraft' => $aircraft,
            'form'    => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Aircraft entity.
     */
    public function showAction(FiAircraft $aircraft)
    {
        $deleteForm = $this->createDeleteForm($aircraft);

        return $this->render('OnicFlightInventoryBundle:Aircraft:show.html.twig', array(
            'aircraft'     => $aircraft,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Aircraft entity.
     */
    public function editAction(Request $request, FiAircraft $aircraft)
    {
        $deleteForm = $this->createDeleteForm($aircraft);
        $editForm   = $this->createForm('Onic\FlightInventoryBundle\Form\FiAircraftType', $aircraft);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aircraft);
            $em->flush();

            return $this->redirectToRoute('aircraft_edit', array('id' => $aircraft->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Aircraft:edit.html.twig', array(
            'aircraft'     => $aircraft,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Aircraft entity.
     */
    public function deleteAction(Request $request, FiAircraft $aircraft)
    {
        $form = $this->createDeleteForm($aircraft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aircraft);
            $em->flush();
        }

        return $this->redirectToRoute('aircraft_index');
    }

    /**
     * Creates a form to delete a Aircraft entity.
     * @param Aircraft $aircraft The Aircraft entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FiAircraft $aircraft)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aircraft_delete', array('id' => $aircraft->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
