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
        return $this->render('FrontendBundle::index.html.twig');
    }

   	 /**
     * @Route("/contacto")
     */
    public function contactoAction()
    {
        return $this->render('FrontendBundle::contacto.html.twig');
    }
     /**
     * @Route("/nosotros")
     */
    public function nostrosAction()
    {
        return $this->render('FrontendBundle::nosotros.html.twig');
    }
     /**
     * @Route("/galeria")
     */
    public function galeriaAction()
    {
        return $this->render('FrontendBundle::galeria.html.twig');
    }

     /**
     * @Route("/tienda")
     */
    public function tiendaAction()
    {
        return $this->render('FrontendBundle::tienda.html.twig');
    }


}
