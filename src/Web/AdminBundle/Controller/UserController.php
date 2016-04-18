<?php

namespace Web\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\SecurityBundle\Entity\User;
use Web\AdminBundle\Form\UserType;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all ser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('WebSecurityBundle:User')->findAll();
        $translated = $this->get('translator')->trans('Hello');
        return $this->render('WebAdminBundle:User:index.html.twig', array(
            'Users' => $user,
            'trans'=>$translated,
        ));
    }

    /**
     * Creates a new User entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('Web\AdminBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $user->getAvatar();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $avatarDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/avatars';
            $file->move($avatarDir, $fileName);
            $user->setAvatar($fileName);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_users_show', array('id' => $user->getId()));
        }

        return $this->render('WebAdminBundle:User:new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction(User $user)
    {


        return $this->render('WebAdminBundle:User:show.html.twig', array(
            'User' => $user,
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm('Web\AdminBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $user->getAvatar();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $avatarDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/avatars';
            $file->move($avatarDir, $fileName);
            $user->setAvatar($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_users_edit', array('id' => $user->getId()));
        }

        return $this->render('WebAdminBundle:User:edit.html.twig', array(
            'User' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, User $user)
    {


        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('admin_users_index');
    }
}

