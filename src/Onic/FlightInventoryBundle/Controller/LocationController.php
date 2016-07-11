<?php

namespace Onic\FlightInventoryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Onic\FlightInventoryBundle\Entity\FiLocation;
use Onic\FlightInventoryBundle\Form\FiLocationType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Location controller.
 */
class LocationController extends Controller
{
    /**
     * Location auto complete for drop down
     * */
    public function autocompleteAction(Request $request)
    {
        $names = array();
        $term  = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OnicFlightInventoryBundle:FiLocation')->createQueryBuilder('c')
            ->where('c.name LIKE :name')
            ->setParameter('name', '%' . $term . '%')
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity/* @var $entity FiLocation */)
        {
            $names[] = array('label' => $entity->getName(), 'value' => $entity->getId());
        }

        $response = new JsonResponse();
        $response->setData($names);

        return $response;
    }

    /**
     * Lists all Location entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locations = $em->getRepository('OnicFlightInventoryBundle:FiLocation')->findAll();

        return $this->render('OnicFlightInventoryBundle:Location:index.html.twig', array(
            'locations' => $locations,
        ));
    }

    /**
     * Creates a new Location entity.
     */
    public function newAction(Request $request)
    {
        $location = new FiLocation();
        $form     = $this->createForm('Onic\FlightInventoryBundle\Form\FiLocationType', $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();

            return $this->redirectToRoute('location_show', array('id' => $location->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Location:new.html.twig', array(
            'location' => $location,
            'form'     => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Location entity.
     */
    public function showAction(FiLocation $location)
    {
        $deleteForm = $this->createDeleteForm($location);

        return $this->render('OnicFlightInventoryBundle:Location:show.html.twig', array(
            'location'    => $location,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Location entity.
     */
    public function editAction(Request $request, FiLocation $location)
    {
        $deleteForm = $this->createDeleteForm($location);
        $editForm   = $this->createForm('Onic\FlightInventoryBundle\Form\FiLocationType', $location);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();

            return $this->redirectToRoute('location_edit', array('id' => $location->getId()));
        }

        return $this->render('OnicFlightInventoryBundle:Location:edit.html.twig', array(
            'location'    => $location,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Location entity.
     */
    public function deleteAction(Request $request, FiLocation $location)
    {
        $form = $this->createDeleteForm($location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($location);
            $em->flush();
        }

        return $this->redirectToRoute('location_index');
    }

    /**
     * Creates a form to delete a Location entity.
     * @param Location $location The Location entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FiLocation $location)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('location_delete', array('id' => $location->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
