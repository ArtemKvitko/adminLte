<?php

namespace Web\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\AdminBundle\Entity\Counter;
use Web\AdminBundle\Form\CounterType;

/**
 * Counter controller.
 *
 */
class CounterController extends Controller
{
    /**
     * Lists all Counter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $counters = $em->getRepository('WebAdminBundle:Counter')->findAll();

        return $this->render('WebAdminBundle:Counter:index.html.twig', array(
            'counters' => $counters,
        ));
    }

    /**
     * Creates a new Counter entity.
     *
     */
    public function newAction(Request $request)
    {
        $counter = new Counter();
        $form = $this->createForm('Web\AdminBundle\Form\CounterType', $counter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($counter);
            $counter->setCreated(new \DateTime(Date("Y-m-d H:i:s", time())));
            $counter->setUpdated(new \DateTime(Date("Y-m-d H:i:s", time())));
            $em->flush();

            return $this->redirectToRoute('Admin_Counter_show', array('id' => $counter->getId()));
        }

        return $this->render('WebAdminBundle:Counter:new.html.twig', array(
            'counter' => $counter,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Counter entity.
     *
     */
    public function showAction(Counter $counter)
    {
        $deleteForm = $this->createDeleteForm($counter);

        return $this->render('WebAdminBundle:Counter:show.html.twig', array(
            'counter' => $counter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Counter entity.
     *
     */
    public function editAction(Request $request, Counter $counter)
    {
        $deleteForm = $this->createDeleteForm($counter);
        $editForm = $this->createForm('Web\AdminBundle\Form\CounterType', $counter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $counter->setUpdated(new \DateTime(Date("Y-m-d H:i:s", time())));
            $em->persist($counter);
            $em->flush();

            return $this->redirectToRoute('Admin_Counter_edit', array('id' => $counter->getId()));
        }

        return $this->render('WebAdminBundle:Counter:edit.html.twig', array(
            'counter' => $counter,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Counter entity.
     *
     */
    public function deleteAction(Request $request, Counter $counter)
    {
        $form = $this->createDeleteForm($counter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($counter);
            $em->flush();
        }

        return $this->redirectToRoute('Admin_Counter_index');
    }

    /**
     * Creates a form to delete a Counter entity.
     *
     * @param Counter $counter The Counter entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Counter $counter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Admin_Counter_delete', array('id' => $counter->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
