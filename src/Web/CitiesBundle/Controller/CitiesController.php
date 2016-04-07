<?php

namespace Web\CitiesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\CitiesBundle\Entity\Cities;
use Web\CitiesBundle\Form\CitiesType;

/**
 * Cities controller.
 *
 */
class CitiesController extends Controller
{
    /**
     * Lists all Cities entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cities = $em->getRepository('WebCitiesBundle:Cities')->findAll();

        return $this->render('WebCitiesBundle:cities:index.html.twig', array(
            'cities' => $cities,
        ));
    }

    /**
     * Creates a new Cities entity.
     *
     */
    public function newAction(Request $request)
    {
        $city = new Cities();
        $form = $this->createForm('Web\CitiesBundle\Form\CitiesType', $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            return $this->redirectToRoute('cities_index');
        }

        return $this->render('WebCitiesBundle:cities:new.html.twig', array(
            'city' => $city,
            'form' => $form->createView(),
        ));
    }

   

    /**
     * Displays a form to edit an existing Cities entity.
     *
     */
    public function editAction(Request $request, Cities $city)
    {
        $deleteForm = $this->createDeleteForm($city);
        $editForm = $this->createForm('Web\CitiesBundle\Form\CitiesType', $city);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            return $this->redirectToRoute('cities_edit', array('id' => $city->getId()));
        }

        return $this->render('WebCitiesBundle:cities:edit.html.twig', array(
            'city' => $city,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cities entity.
     *
     */
    public function deleteAction(Request $request, Cities $city)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($city);
        $em->flush();

        return $this->redirectToRoute('cities_index');
    }

    /**
     * Creates a form to delete a Cities entity.
     *
     * @param Cities $city The Cities entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cities $city)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cities_delete', array('id' => $city->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
