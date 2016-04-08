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
class AssetsController extends Controller
{
    /**
     * Lists all Assets entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assets = $em->getRepository('WebAssetsBundle:Assets')->findAll();

        return $this->render('assets/index.html.twig', array(
            'assets' => $assets,
        ));
    }

    /**
     * Creates a new Assets entity.
     *
     */
    public function newAction(Request $request)
    {
        $asset = new Assets();
        $form = $this->createForm('Web\AssetsBundle\Form\AssetsType', $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asset);
            $em->flush();

            return $this->redirectToRoute('assets_show', array('id' => $asset->getId()));
        }

        return $this->render('assets/new.html.twig', array(
            'asset' => $asset,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Assets entity.
     *
     */
    public function showAction(Assets $asset)
    {
        $deleteForm = $this->createDeleteForm($asset);

        return $this->render('assets/show.html.twig', array(
            'asset' => $asset,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Assets entity.
     *
     */
    public function editAction(Request $request, Assets $asset)
    {
        $deleteForm = $this->createDeleteForm($asset);
        $editForm = $this->createForm('Web\AssetsBundle\Form\AssetsType', $asset);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asset);
            $em->flush();

            return $this->redirectToRoute('assets_edit', array('id' => $asset->getId()));
        }

        return $this->render('assets/edit.html.twig', array(
            'asset' => $asset,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Assets entity.
     *
     */
    public function deleteAction(Request $request, Assets $asset)
    {
        $form = $this->createDeleteForm($asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($asset);
            $em->flush();
        }

        return $this->redirectToRoute('assets_index');
    }

    /**
     * Creates a form to delete a Assets entity.
     *
     * @param Assets $asset The Assets entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Assets $asset)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('assets_delete', array('id' => $asset->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}