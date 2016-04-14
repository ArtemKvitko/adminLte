<?php

namespace Web\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\AdminBundle\Entity\Types;
use Web\AdminBundle\Form\TypesType;

/**
 * Types controller.
 *
 */
class TypesController extends Controller
{
    /**
     * Lists all Types entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('WebAdminBundle:Types')->findAll();

        return $this->render('WebAdminBundle:Types:index.html.twig', array(
            'types' => $types,
        ));
    }

    /**
     * Creates a new Types entity.
     *
     */
    public function newAction(Request $request)
    {
        $type = new Types();
        $form = $this->createForm('Web\AdminBundle\Form\TypesType', $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('Admin_Types_show', array('id' => $type->getId()));
        }

        return $this->render('WebAdminBundle:Types:new.html.twig', array(
            'type' => $type,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Types entity.
     *
     */
    public function showAction(Types $type)
    {
        $deleteForm = $this->createDeleteForm($type);

        return $this->render('WebAdminBundle:Types:show.html.twig', array(
            'type' => $type,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Types entity.
     *
     */
    public function editAction(Request $request, Types $type)
    {
        $deleteForm = $this->createDeleteForm($type);
        $editForm = $this->createForm('Web\AdminBundle\Form\TypesType', $type);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('Admin_Types_index', array('id' => $type->getId()));
        }

        return $this->render('WebAdminBundle:Types:edit.html.twig', array(
            'type' => $type,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Types entity.
     *
     */
    public function deleteAction(Request $request, Types $type)
    {
        $form = $this->createDeleteForm($type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($type);
            $em->flush();
        }

        return $this->redirectToRoute('Admin_Types_index');
    }

    /**
     * Creates a form to delete a Types entity.
     *
     * @param Types $type The Types entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Types $type)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Admin_Types_delete', array('id' => $type->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
