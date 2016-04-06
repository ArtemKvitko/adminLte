<?php

namespace Web\CitiesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebCitiesBundle:Default:index.html.twig');
    }
}
