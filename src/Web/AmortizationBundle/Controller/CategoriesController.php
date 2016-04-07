<?php

namespace Web\AmortizationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\AmortizationBundle\Entity\Categories;
use Web\AmortizationBundle\Form\CategoriesType;

/**
 * Categories controller.
 *
 */
class CategoriesController extends Controller
{
    /**
     * Lists all Categories entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('WebAmortizationBundle:Categories')->findAll();

        return $this->render('WebAmortizationBundle:Categories:index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new Categories entity.
     *
     */
    public function newAction(Request $request)
    {
        $category = new Categories();
        $form = $this->createForm(new CategoriesType(), $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('categories_show', array('id' => $category->getId()));
        }

        return $this->render('WebAmortizationBundle:Categories:new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categories entity.
     *
     */
    public function showAction(Categories $category)
    {        
        return $this->render('WebAmortizationBundle:Categories:show.html.twig', array(
            'category' => $category,
            'delete_url' => $this->createDeleteUrl($category),
        ));
    }

    /**
     * Displays a form to edit an existing Categories entity.
     *
     */
    public function editAction(Request $request, Categories $category)
    {        
        $editForm = $this->createForm(new CategoriesType(), $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('categories_edit', array('id' => $category->getId()));
        }

        return $this->render('WebAmortizationBundle:Categories:edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_url' => $this->createDeleteUrl($category),
        ));
    }

    /**
     * Deletes a Categories entity.
     *
     */
    public function deleteAction(Request $request)
    {        
        $id = $request->get('id');
        
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('WebAmortizationBundle:Categories')->findOneById($id);
        
        if (empty($category)) {
            return $this->redirectToRoute('categories_index');
        }
        
        $em->remove($category);
        $em->flush();
        
        return $this->redirectToRoute('categories_index');
    }

    /**
     * Creates a form to delete a Categories entity.
     *
     * @param Categories $category The Categories entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteUrl(Categories $category)
    {
        //echo $this->generateUrl('categories_delete', array('id' => $category->getId()));
        
        /*
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categories_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;*/
        
        return $this->generateUrl('categories_delete', array('id' => $category->getId()));
    }
}
