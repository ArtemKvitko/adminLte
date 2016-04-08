<?php

namespace Web\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Web\AssetsBundle\Entity\Assets;
use Web\AssetsBundle\Form\AssetsType;

/**
 * Assets controller.
 *
 */
class AssetsController extends Controller {

    /**
     * Lists all Assets entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $assets = $em->getRepository('WebAssetsBundle:Assets')->findAll();

        return $this->render('WebAssetsBundle:Assets:index.html.twig', array(
                    'assets' => $assets,
        ));
    }

    /**
     * Creates a new Assets entity.
     *
     */
    public function newAction(Request $request) {
        $asset = new Assets();
        $form = $this->createForm('Web\AssetsBundle\Form\AssetsType', $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asset);
            $em->flush();

            return $this->redirectToRoute('assets_show', array('id' => $asset->getId()));
        }

        return $this->render('WebAssetsBundle:Assets:new.html.twig', array(
                    'asset' => $asset,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Assets entity.
     *
     */
    public function showAction(Assets $asset) {


        return $this->render('WebAssetsBundle:Assets:show.html.twig', array(
                    'asset' => $asset
        ));
    }

    /**
     * Displays a form to edit an existing Assets entity.
     *
     */
    public function editAction(Request $request, Assets $asset) {

        $editForm = $this->createForm('Web\AssetsBundle\Form\AssetsType', $asset);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asset);
            $em->flush();

            return $this->redirectToRoute('assets_edit', array('id' => $asset->getId()));
        }

        return $this->render('WebAssetsBundle:Assets:edit.html.twig', array(
                    'asset' => $asset,
                    'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a Assets entity.
     *
     */
    public function deleteAction(Request $request, Assets $asset) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($asset);
        $em->flush();

        return $this->redirectToRoute('assets_index');
    }

}
