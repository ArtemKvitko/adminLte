<?php

namespace Web\AssetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebAssetsBundle:Default:index.html.twig');
    }
}
