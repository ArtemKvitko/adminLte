<?php

namespace Web\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\AdminBundle\Entity\PlaceInstallation;
use Web\AdminBundle\Form\PlaceInstallationType;

/**
 * PlaceInstallation controller.
 *
 */
class PlaceInstallationController extends Controller
{
    /**
     * Lists all PlaceInstallation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $placeInstallations = $em->getRepository('WebAdminBundle:PlaceInstallation')->findAll();

        return $this->render('WebAdminBundle:PlaceInstallation:index.html.twig', array(
            'placeInstallations' => $placeInstallations,
        ));
    }

    /**
     * Creates a new PlaceInstallation entity.
     *
     */
    public function newAction(Request $request)
    {
        $placeInstallation = new PlaceInstallation();
        $form = $this->createForm('Web\AdminBundle\Form\PlaceInstallationType', $placeInstallation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($placeInstallation);
            $em->flush();

            return $this->redirectToRoute('Admin_PlaceInstallation_show', array('id' => $placeInstallation->getId()));
        }

        return $this->render('WebAdminBundle:PlaceInstallation:new.html.twig', array(
            'placeInstallation' => $placeInstallation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PlaceInstallation entity.
     *
     */
    public function showAction(PlaceInstallation $placeInstallation)
    {
        $deleteForm = $this->createDeleteForm($placeInstallation);

        return $this->render('WebAdminBundle:PlaceInstallation:show.html.twig', array(
            'placeInstallation' => $placeInstallation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PlaceInstallation entity.
     *
     */
    public function editAction(Request $request, PlaceInstallation $placeInstallation)
    {
        $deleteForm = $this->createDeleteForm($placeInstallation);
        $editForm = $this->createForm('Web\AdminBundle\Form\PlaceInstallationType', $placeInstallation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($placeInstallation);
            $em->flush();

            return $this->redirectToRoute('Admin_PlaceInstallation_index', array('id' => $placeInstallation->getId()));
        }

        return $this->render('WebAdminBundle:PlaceInstallation:edit.html.twig', array(
            'placeInstallation' => $placeInstallation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PlaceInstallation entity.
     *
     */
    public function deleteAction(Request $request, PlaceInstallation $placeInstallation)
    {
        $form = $this->createDeleteForm($placeInstallation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($placeInstallation);
            $em->flush();
        }

        return $this->redirectToRoute('Admin_PlaceInstallation_index');
    }

    /**
     * Creates a form to delete a PlaceInstallation entity.
     *
     * @param PlaceInstallation $placeInstallation The PlaceInstallation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PlaceInstallation $placeInstallation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Admin_PlaceInstallation_delete', array('id' => $placeInstallation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
