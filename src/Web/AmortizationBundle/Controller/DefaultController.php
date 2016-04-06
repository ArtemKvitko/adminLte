<?php

namespace Web\AmortizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebAmortizationBundle:Default:index.html.twig');
    }
}
