<?php

namespace Web\AmortizationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\AmortizationBundle\Entity\Amortization;
use Web\AmortizationBundle\Form\AmortizationType;
use \Web\AmortizationBundle\Entity\Categories;

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
        
        return $this->render('WebAmortizationBundle:Amortization:show.html.twig', array(
            'amortization' => $amortization,
            'delete_url' => $this->createDeleteUrl($amortization),
        ));
    }

    /**
     * Displays a form to edit an existing Amortization entity.
     *
     */
    public function editAction(Request $request, Amortization $amortization)
    {
        //echo $amortization->id;
        //exit();
        
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
            'delete_url' => $this->createDeleteUrl($amortization),
        ));
    }

    /**
     * Deletes a Amortization entity.
     *
     */
    public function deleteAction(Request $request)
    {
               
        $id = $request->get('id');
        
        $em = $this->getDoctrine()->getManager();
        $amortization = $em->getRepository('WebAmortizationBundle:Amortization')->findOneById($id);
        
        if (empty($amortization)) {
            return $this->redirectToRoute('amortization_index');
        }
        
        $em->remove($amortization);
        $em->flush();
        
        return $this->redirectToRoute('amortization_index');        
        
    }

    /**
     * Creates a form to delete a Amortization entity.
     *
     * @param Amortization $amortization The Amortization entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteUrl(Amortization $amortization)
    {
        /*
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('amortization_delete', array('id' => $amortization->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;*/
        
        return $this->generateUrl('amortization_delete', array('id' => $amortization->getId()));
    }
    
       public function calcAction(Request $request)
    {
        
        
        
       
        $em = $this->getDoctrine()->getManager();
        $amortizations = $em->getRepository('WebAmortizationBundle:Amortization')->findAll();

        $amortization_s = $em->getRepository('WebAmortizationBundle:Categories')->findAll();
        
        $cat = new Categories();
        $cat->getUsefulTime();
        var_dump($amortization_s);exit();
                        
        //echo rand(0, 111111).'<hr/>';
        

        return $this->render('WebAmortizationBundle:Amortization:index.html.twig', array(
            'amortizations' => $amortizations
        ));
        
        
    }
}
