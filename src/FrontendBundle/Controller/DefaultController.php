<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/frontend")
     */
    public function indexAction()
    {
        return $this->render('FrontendBundle::template.html.twig');
    }
}
