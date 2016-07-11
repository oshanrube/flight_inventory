<?php

namespace Onic\FlightInventoryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Onic\FlightInventoryBundle\Entity\FiBooking;
use Onic\FlightInventoryBundle\Form\FiBookingType;

/**
 * Booking controller.
 */
class BookingController extends Controller
{
    /**
     * Lists all Booking entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bookings = $em->getRepository('OnicFlightInventoryBundle:FiBooking')->findAll();

        return $this->render('OnicFlightInventoryBundle:Booking:index.html.twig', array(
            'bookings' => $bookings,
        ));
    }

    /**
     * Creates a new Booking entity.
     */
    public function newAction(Request $request)
    {
        $booking = new FiBooking();
        $form    = $this->createForm('Onic\FlightInventoryBundle\Form\FiBookingType', $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('booking_show', array('id' => $booking->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Booking:new.html.twig', array(
            'booking' => $booking,
            'form'    => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Booking entity.
     */
    public function showAction(FiBooking $booking)
    {
        $deleteForm = $this->createDeleteForm($booking);

        return $this->render('OnicFlightInventoryBundle:Booking:show.html.twig', array(
            'booking'     => $booking,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Booking entity.
     */
    public function editAction(Request $request, FiBooking $booking)
    {
        $deleteForm = $this->createDeleteForm($booking);
        $editForm   = $this->createForm('Onic\FlightInventoryBundle\Form\FiBookingType', $booking);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('booking_edit', array('id' => $booking->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Booking:edit.html.twig', array(
            'booking'     => $booking,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Booking entity.
     */
    public function deleteAction(Request $request, FiBooking $booking)
    {
        $form = $this->createDeleteForm($booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($booking);
            $em->flush();
        }

        return $this->redirectToRoute('booking_index');
    }

    /**
     * Creates a form to delete a Booking entity.
     * @param Booking $booking The Booking entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FiBooking $booking)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('booking_delete', array('id' => $booking->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
