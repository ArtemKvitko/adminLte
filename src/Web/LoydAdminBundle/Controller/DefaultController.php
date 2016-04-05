<?php

namespace Web\LoydAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LoydAdminBundle:Default:index.html.twig');
    }
}
