<?php

namespace Web\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebSecurityBundle:Default:index.html.twig');
    }
}
