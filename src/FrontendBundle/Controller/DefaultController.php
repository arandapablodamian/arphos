<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\Turno;
use BackendBundle\Entity\Category;
use BackendBundle\Entity\Mensaje;
use FrontendBundle\Form\FormularioTurnoType;
use FrontendBundle\Form\FormularioContactoType;


/**
     * @Route("/frontend")
     */
class DefaultController extends Controller
{
    /**
     * @Route("/" , name="index")
     */
    public function indexAction(Request $request)
    {	$turno = new Turno();
          $formularioTurno = $this->createForm(FormularioTurnoType::class, $turno);
           
            $formularioTurno->handleRequest($request);
           

        //     if ($form->isSubmitted() && $form->isValid()) {
              
        //         // $form->getData() holds the submitted values
        //         // but, the original `$task` variable has also been updated
        //         $formularioContacto = $form->getData();

        //         $message = (new \Swift_Message('Contacto'))
        //         ->setSubject('Contacto')
        //         ->setFrom(array($formularioContacto->email=>$formularioContacto->email))
        //         ->setTo('mecon.jocampo@chaco.gov.ar')
        //         ->setBody("Nombre y Apellido: ".$formularioContacto->nomyap. "\n\nTeléfono: ".$formularioContacto->telefono."\n\n Mensaje: \n\t\t   ".$formularioContacto->mensaje );
        //         $this->get('mailer')->send($message);

        //     return $this->render('FrontendBundle:EntidadEnlace:envioexitoso.html.twig');
        // }

        // return $this->render('FrontendBundle:EntidadEnlace:contacto.html.twig',array(
        //     'form' => $form->createView(),
        // ));
        return $this->render('FrontendBundle::index.html.twig',array(
        	'formularioTurno'=>$formularioTurno->createView()));
    }

    /**
     * @Route("/contacto" , name="contacto")
     */
    public function contactoAction(Request $request)
    {   $mensaje = new Mensaje();
          $formularioContacto = $this->createForm(FormularioContactoType::class, $mensaje);
           
            $formularioContacto->handleRequest($request);

            if ($formularioContacto->isSubmitted() && $formularioContacto->isValid()) {
              
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $formularioContacto = $formularioContacto->getData();

                $message = (new \Swift_Message('Contacto'))
                ->setSubject('Contacto')
                ->setFrom($formularioContacto->getEmail())
                ->setTo('arandapablodamian@gmail.com')
                ->setBody("Nombre y Apellido: ".$formularioContacto->getNombre().', '.$formularioContacto->getApellido(). "\n\nTeléfono: ".$formularioContacto->getTelefono()."\n\n Mensaje: \n\t\t   ".$formularioContacto->getMensaje() );
                $this->get('mailer')->send($message);

            dump('envio exitoso');
            die;
        }

      
        return $this->render('FrontendBundle::contacto.html.twig',array(
            'formularioContacto'=>$formularioContacto->createView()));
    }

  
     /**
     * @Route("/nosotros" , name="nosotros")
     */
    public function nostrosAction()
    {   
        return $this->render('FrontendBundle::nosotros.html.twig');
    }
     /**
     * @Route("/galeria", name="galeria")
     */
    public function galeriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager(); 
        $query = $em->createQuery('SELECT g FROM BackendBundle:Galeria g WHERE g.publicado=1 ORDER BY g.orden DESC');


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('FrontendBundle::galeria.html.twig', array('pagination' => $pagination));
        
    }

    /**
     * @Route("/blog{categoria}", name="blog")
     */
    public function blogAction($categoria = 0)
    {          
        $em = $this->getDoctrine()->getManager(); 
        if (!$categoria || $categoria==0) {
            $query = $em->createQuery('SELECT p FROM BackendBundle:Pagina p WHERE p.publicado=1 ORDER BY p.fechaCreacion DESC') ->setMaxResults(10);
            $entradas = $query->getResult();
        }else{
            $query = $em->createQuery('SELECT p FROM BackendBundle:Pagina p WHERE p.publicado=1 AND p.categoria =:categoria ORDER BY p.fechaCreacion DESC');
            $query->setParameter('categoria', $categoria);
            $entradas = $query->getResult();
        }

         $query = $em->createQuery('SELECT c FROM BackendBundle:CategoriaPagina c ORDER BY c.titulo DESC');
            $categorias = $query->getResult();

        return $this->render('FrontendBundle::blog.html.twig', array(
            'entradas'=>$entradas,
            'categoria'=>$categoria,
            'categorias'=>$categorias));
    }


    /**
     * @Route("/detalleEntrada{idPagina}", name="detalleEntrada")
     */
    public function detalleEntrada($idPagina)
    {          
        $em = $this->getDoctrine()->getManager(); 

            $query = $em->createQuery('SELECT p FROM BackendBundle:Pagina p WHERE p.id=:idPagina');
            $query->setParameter('idPagina', $idPagina);
            $entrada = $query->getSingleResult();
        
         $query = $em->createQuery('SELECT c FROM BackendBundle:CategoriaPagina c ORDER BY c.titulo DESC');
            $categorias = $query->getResult();

        return $this->render('FrontendBundle::detalleEntrada.html.twig', array(
            'entrada'=>$entrada,
            'categorias'=>$categorias));
    }

}