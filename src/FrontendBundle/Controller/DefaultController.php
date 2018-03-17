<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\Turno;
use BackendBundle\Entity\Category;
use FrontendBundle\Form\FormularioTurnoType;

/**
     * @Route("/frontend")
     */
class DefaultController extends Controller
{
    /**
     * @Route("/index" , name="index")
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
    public function contactoAction()
    {
        return $this->render('FrontendBundle::contacto.html.twig');
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
    public function galeriaAction()
    {
        return $this->render('FrontendBundle::galeria.html.twig');
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
            $query = $em->createQuery('SELECT p FROM BackendBundle:Pagina p WHERE p.publicado=1 AND p.categoria.id =:categoria ORDER BY p.fechaCreacion DESC');
            $query->setParameter('categoria', $categoria);
            $entradas = $query->getResult();
        }
        return $this->render('FrontendBundle::blog.html.twig', array(
            'entradas'=>$entradas,
            'categoria'=>$categoria));
    }


}