<?php

namespace Onic\FlightInventoryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Onic\FlightInventoryBundle\Entity\FiFlight;
use Onic\FlightInventoryBundle\Form\FiFlightType;

/**
 * Flight controller.
 */
class FlightController extends Controller
{
    /**
     * Lists all Flight entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $flights = $em->getRepository('OnicFlightInventoryBundle:FiFlight')->findAll();

        return $this->render('OnicFlightInventoryBundle:Flight:index.html.twig', array(
            'flights' => $flights,
        ));
    }

    /**
     * Creates a new Flight entity.
     */
    public function newAction(Request $request)
    {
        $flight = new FiFlight();
        $form   = $this->createForm(\Onic\FlightInventoryBundle\Form\FiFlightType::class, $flight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($flight);
            $em->flush();

            return $this->redirectToRoute('flight_show', array('id' => $flight->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Flight:new.html.twig', array(
            'flight' => $flight,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Flight entity.
     */
    public function showAction(FiFlight $flight)
    {
        $deleteForm = $this->createDeleteForm($flight);

        return $this->render('OnicFlightInventoryBundle:Flight:show.html.twig', array(
            'flight'      => $flight,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Flight entity.
     */
    public function editAction(Request $request, FiFlight $flight)
    {
        $deleteForm = $this->createDeleteForm($flight);
        $editForm   = $this->createForm('Onic\FlightInventoryBundle\Form\FiFlightType', $flight);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($flight);
            $em->flush();

            return $this->redirectToRoute('flight_edit', array('id' => $flight->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Flight:edit.html.twig', array(
            'flight'      => $flight,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Flight entity.
     */
    public function deleteAction(Request $request, FiFlight $flight)
    {
        $form = $this->createDeleteForm($flight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($flight);
            $em->flush();
        }

        return $this->redirectToRoute('flight_index');
    }

    /**
     * Creates a form to delete a Flight entity.
     * @param Flight $flight The Flight entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FiFlight $flight)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('flight_delete', array('id' => $flight->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
