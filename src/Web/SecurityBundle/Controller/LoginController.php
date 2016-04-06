<?php

namespace Web\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('WebSecurityBundle:Login:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * Never used due to Symfony's Security component
     */
    public function loginCheckAction(){}

    /**
     * Never used due to Symfony's Security component
     */
    public function logoutAction(){}
}
