<?php

namespace Web\AmortizationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Web\AmortizationBundle\Entity\Amortization;
use Web\AmortizationBundle\Form\AmortizationType;
use \Web\AmortizationBundle\Entity\Categories;
use Web\AssetsBundle\Entity\Assets;
use \Symfony\Component\Validator\Constraints\DateTime;

/**
 * Amortization controller.
 *
 */
class AmortizationController extends Controller {

    /**
     * Lists all Amortization entities.
     *
     */
    //

    public function indexAction() {
        //echo rand(11, 23424234);
        //echo $translated = $this->get('translator')->trans('Symfony is great');

        $em = $this->getDoctrine()->getManager();

        $amortizations = $em->getRepository('WebAmortizationBundle:Amortization')->findAll();

        foreach ($amortizations as $val) {

            $aset = empty($val->getAset()) ? "" : $val->getAset()->getTitle();
            $arr_period[$val->getPeriod()->format('Y-m-d')][$aset] = "";
        }


        return $this->render('WebAmortizationBundle:Amortization:index.html.twig', array(
                    'amortizations' => $amortizations,
                    'arr_period' => $arr_period
        ));
    }

    /**
     * Creates a new Amortization entity.
     *
     */
    public function newAction(Request $request) {
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
    public function showAction(Amortization $amortization) {

        return $this->render('WebAmortizationBundle:Amortization:show.html.twig', array(
                    'amortization' => $amortization,
                    'delete_url' => $this->createDeleteUrl($amortization),
        ));
    }

    /**
     * Displays a form to edit an existing Amortization entity.
     *
     */
    public function editAction(Request $request, Amortization $amortization) {
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
    public function deleteAction(Request $request) {

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
    private function createDeleteUrl(Amortization $amortization) {
        /*
          return $this->createFormBuilder()
          ->setAction($this->generateUrl('amortization_delete', array('id' => $amortization->getId())))
          ->setMethod('DELETE')
          ->getForm()
          ; */

        return $this->generateUrl('amortization_delete', array('id' => $amortization->getId()));
    }

    public function calcAction(Request $request) {

        $row = $request->get('menu');

        if (empty($row)) {
            return $this->redirectToRoute('amortization_index');
        }

        $arr = explode("::", $row);
        if (Count($arr) < 2) {
            return $this->redirectToRoute('amortization_index');
        }

        $em = $this->getDoctrine()->getManager();
        $as = $em->getRepository('WebAssetsBundle:Assets')->findOneByTitle($arr[1]);
        $qwy = $as->getInitialcost();
        //var_dump($qwy);
        $as1 = $em->getRepository('WebAssetsBundle:Assets')->findOneByTitle($arr[1]);
        $gt = $as1->getCategory()->__toString();
        //echo $gt;
        $as2 = $em->getRepository('WebAmortizationBundle:Categories')->findOneByTitle($gt);
        $rts = $as2->getUsefulTime();
        //echo $rts;

        $a = $arr[0];
        //$ab =(date($a));
        $d = new \DateTime($a);
        $as3 = $em->getRepository('WebAmortizationBundle:Amortization')->findOneByPeriod($d);
        $wer = $as3->getAmortization();
        if ($wer == 0) {
            $er = (int) $qwy;
            $a = $er / $rts / 4;
            $b = (int) $a;
            $wer = $as3->setAmortization($b);
            $em->persist($as3);
            $em->flush();
            return $this->redirectToRoute('amortization_index');
        } else {
            return $this->redirectToRoute('amortization_index');
        }

        $amortizations = $em->getRepository('WebAmortizationBundle:Amortization')->findAll();
        $amortization_s = $em->getRepository('WebAmortizationBundle:Categories')->findAll();



        //echo rand(0, 111111).'<hr/>';


        return $this->render('WebAmortizationBundle:Amortization:index.html.twig', array(
                    'amortizations' => $amortizations
        ));
    }

}
