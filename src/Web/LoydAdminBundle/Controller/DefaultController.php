<?php

namespace Web\LoydAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LoydAdminBundle::base.html.twig');
    }
    public function loginAction()
    {
        return $this->render('LoydAdminBundle:Login:login.html.twig');
    }
}
