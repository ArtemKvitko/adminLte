<?php

namespace Web\AmortizationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\AmortizationBundle\Entity\Amortization;
use Web\AmortizationBundle\Form\AmortizationType;

/**
 * Amortization controller.
 *
 */
class AmortizationController extends Controller
{
    /**
     * Lists all Amortization entities.
     *
     */
    //
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $amortizations = $em->getRepository('WebAmortizationBundle:Amortization')->findAll();        
        
        //echo rand(0, 111111).'<hr/>';
        
        return $this->render('WebAmortizationBundle:Amortization:index.html.twig', array(
            'amortizations' => $amortizations,
        ));
        
        
    }

    /**
     * Creates a new Amortization entity.
     *
     */
    public function newAction(Request $request)
    {
        $amortization = new Amortization();
        $form = $this->createForm('Web\AmortizationBundle\Form\AmortizationType', $amortization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($amortization);
            $em->flush();

            return $this->redirectToRoute('amortization_show', array('id' => $amortization->getId()));
        }

        return $this->render('WebAmortizationBundle:Amortization:new.html.twig', array(
            'amortization' => $amortization,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Amortization entity.
     *
     */
    public function showAction(Amortization $amortization)
    {
        $deleteForm = $this->createDeleteForm($amortization);
        
        return $this->render('WebAmortizationBundle:Amortization:show.html.twig', array(
            'amortization' => $amortization,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Amortization entity.
     *
     */
    public function editAction(Request $request, Amortization $amortization)
    {
        $deleteForm = $this->createDeleteForm($amortization);
        $editForm = $this->createForm('Web\AmortizationBundle\Form\AmortizationType', $amortization);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($amortization);
            $em->flush();

            return $this->redirectToRoute('amortization_edit', array('id' => $amortization->getId()));
        }

        return $this->render('WebAmortizationBundle:Amortization:edit.html.twig', array(
            'amortization' => $amortization,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Amortization entity.
     *
     */
    public function deleteAction(Request $request, Amortization $amortization)
    {
        $form = $this->createDeleteForm($amortization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($amortization);
            $em->flush();
        }

        return $this->redirectToRoute('amortization_index');
    }

    /**
     * Creates a form to delete a Amortization entity.
     *
     * @param Amortization $amortization The Amortization entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Amortization $amortization)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('amortization_delete', array('id' => $amortization->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
