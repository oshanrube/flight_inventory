<?php

namespace Onic\FlightInventoryBundle\Controller;

use Onic\FlightInventoryBundle\Entity\FiPassenger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Onic\FlightInventoryBundle\Entity\FiFlight;
use Onic\FlightInventoryBundle\Entity\FiBooking;

class FrontendController extends Controller
{
    public function indexAction(Request $request)
    {
        $filters = $this->createForm('Onic\FlightInventoryBundle\Form\FiFlightFilterType');
        $filters->handleRequest($request);
        $flights = array();

        if ($filters->isSubmitted() && $filters->isValid())
        {
            $em            = $this->getDoctrine()->getManager();
            $flights       = $em->getRepository('OnicFlightInventoryBundle:FiFlight')
                ->findAllByFilters($filters->getData());
            $filter_values = $filters->getData();
        }

        return $this->render('OnicFlightInventoryBundle:Frontend:index.html.twig',
            array(
                'filtered'       => $filters->isSubmitted(),
                'filters'        => $filters->createView(),
                'num_passengers' => (isset($filter_values['num_passengers']) ? $filter_values['num_passengers'] : 0),
                'origin'         => (isset($filter_values['idorigin']) ? $filter_values['idorigin'] : ''),
                'destination'    => (isset($filter_values['iddestination']) ? $filter_values['iddestination'] : ''),
                'flights'        => $flights
            ));
    }

    /**
     * Finds and displays a Flight entity.
     */
    public function bookingAction(Request $request, FiFlight $flight)
    {
        $passenger = new FiPassenger();
        $form      = $this->createForm('Onic\FlightInventoryBundle\Form\FiPassengerType', $passenger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            if (null === ($dbpassenger = $em->getRepository('OnicFlightInventoryBundle:FiPassenger')
                    ->findOneBy(array('email' => $passenger->getEmail())))
            )
            {
                //create passenger
                $em->persist($passenger);
                $em->flush();
                $dbpassenger = $passenger;
            }

            if (null === ($booking = $em->getRepository('OnicFlightInventoryBundle:FiBooking')
                    ->findOneBy(array(
                        'idflight'    => $flight,
                        'idpassenger' => $dbpassenger
                    )))
            )
            {
                //create booking
                $booking = new FiBooking();
                $booking->setIdflight($flight);
                $booking->setIdpassenger($dbpassenger);
                $em->persist($booking);
                $em->flush();
                return $this->redirectToRoute('flight_booking_view', array('id' => $booking->getId()));
            }
            else
            {
                //already has a record
                $form->addError(new \Symfony\Component\Form\FormError("this flight is already booked for the given email address"));
            }
        }

        return $this->render('OnicFlightInventoryBundle:Frontend:booking.html.twig', array(
            'passenger' => $passenger,
            'form'      => $form->createView(),
        ));
    }

    /**
     * Finds and displays a booking.
     */
    public function bookingDetailsAction(FiBooking $booking)
    {
        return $this->render('OnicFlightInventoryBundle:Frontend:booking_details.html.twig', array(
            'booking' => $booking
        ));
    }
}
