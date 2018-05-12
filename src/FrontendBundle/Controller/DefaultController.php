<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use BackendBundle\Entity\Turno;
use BackendBundle\Entity\Cliente;
use BackendBundle\Entity\Category;
use BackendBundle\Entity\Mensaje;

//para los formularios
use FrontendBundle\Form\FormularioTurnoType;
use FrontendBundle\Form\FormularioContactoType;
use FrontendBundle\Form\FormularioRegistroType;
use FrontendBundle\Form\FormularioIngresoType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


/**
     * @Route("/frontend")
     */
class DefaultController extends Controller
{
    /**
     * @Route("/" , name="index")
     */
    public function indexAction(Request $request)
    {	  $turno = new Turno();
          $formularioTurno = $this->createForm(FormularioTurnoType::class, $turno);
          //variables para el login
          $variablesLogin=$this->formularios($request);
          $formularioRegistro=$variablesLogin['formularioRegistro'];
          $formularioIngreso=$variablesLogin['formularioIngreso'];
          $mostrarRegistro=$variablesLogin['mostrarRegistro'];
          $mostrarIngreso=$variablesLogin['mostrarIngreso'];
          $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        return $this->render('FrontendBundle::index.html.twig',array(
        	'formularioTurno'=>$formularioTurno->createView(),
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }

    /**
     * @Route("/contacto" , name="contacto")
     */
    public function contactoAction(Request $request)
    {   
        //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        /////////////////////
        $mensaje = new Mensaje();
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
            'formularioContacto'=>$formularioContacto->createView(),
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }

  
     /**
     * @Route("/nosotros" , name="nosotros")
     */
    public function nostrosAction(Request $request)
    {   
         //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        /////////////////////
        return $this->render('FrontendBundle::nosotros.html.twig',array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }
     /**
     * @Route("/galeria", name="galeria")
     */
    public function galeriaAction(Request $request)
    {   
         //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        /////////////////////


        $em = $this->getDoctrine()->getManager(); 
        $query = $em->createQuery('SELECT g FROM BackendBundle:Galeria g WHERE g.publicado=1 ORDER BY g.orden DESC');


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('FrontendBundle::galeria.html.twig', array('pagination' => $pagination,
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
        
    }

    /**
     * @Route("/blog{categoria}", name="blog")
     */
    public function blogAction(Request $request,$categoria = 0)
    {   
         //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        /////////////////////

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
            'categorias'=>$categorias,
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }


    /**
     * @Route("/detalleEntrada{idPagina}", name="detalleEntrada")
     */
    public function detalleEntrada(Request $request,$idPagina)
    {    
         //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        /////////////////////

        $em = $this->getDoctrine()->getManager(); 

            $query = $em->createQuery('SELECT p FROM BackendBundle:Pagina p WHERE p.id=:idPagina');
            $query->setParameter('idPagina', $idPagina);
            $entrada = $query->getSingleResult();
        
         $query = $em->createQuery('SELECT c FROM BackendBundle:CategoriaPagina c ORDER BY c.titulo DESC');
            $categorias = $query->getResult();

        return $this->render('FrontendBundle::detalleEntrada.html.twig', array(
            'entrada'=>$entrada,
            'categorias'=>$categorias,
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }


    public function formularios (Request $request){


         //banderas para saber si muestro o no las ventanas modales de regristro e ingreso,y si ya se logeo al sistema
            $mostrarRegistro=false;
            $mostrarIngreso=false;
            $usuarioInvalido=false;
          //formulario de registro
            $cliente = new Cliente();
            $formularioRegistro = $this->createForm(FormularioRegistroType::class, $cliente);
            $formularioRegistro->handleRequest($request);


            //ahora para la parte de login

                    $clienteIngresando =   new Cliente();

                     $formularioIngreso = $this->createFormBuilder($clienteIngresando)
                        ->add('usuario',null, [
                            'label' => 'Usuario',
                            'attr'=>[
                            ]
                        ])
                        ->add('contrasenia',PasswordType::class, [
                            'label' => 'Contraseña',
                            'attr'=>[
                            ]
                        ])
                        ->add('enviar', SubmitType::class, array(
                            'label' => 'Ingresar','attr'=>['class'=>'btn-success'],
                        ))
                        ->getForm();

                    $formularioIngreso->handleRequest($request);



            if ($formularioRegistro->isSubmitted() && $formularioRegistro->isValid()) {
                $datosCliente = $formularioRegistro->getData();    
                    
                    //guardo el cliente en la base de datos
                    $em = $this->getDoctrine()->getManager(); 
                    //creo una clase cliente
                    $clienteAlta = new Cliente();
                    //le asigno los campos que complete en en formulario de registros
                    $clienteAlta->setNombre($datosCliente->getNombre());
                    $clienteAlta->setApellido($datosCliente->getApellido());
                    $clienteAlta->setEmail($datosCliente->getEmail());
                    $clienteAlta->setDireccion($datosCliente->getDireccion());
                    $clienteAlta->setTelefono($datosCliente->getTelefono());
                    $clienteAlta->setUsuario($datosCliente->getUsuario());
                    $clienteAlta->setContrasenia(md5($datosCliente->getContrasenia()));
                    //persisto el cliente
                    $em->persist($clienteAlta); 
                    //ejecuto la consulta
                    $em->flush();

                     return $this->render('FrontendBundle::registracion_exitosa.html.twig',array(
                    'formularioTurno'=>$formularioTurno->createView(),
                    'formularioRegistro'=>$formularioRegistro->createView(),
                    'formularioIngreso'=> $formularioIngreso->createView()));

                    }elseif ($formularioRegistro->isSubmitted() && !$formularioRegistro->isValid()) {
                        $mostrarRegistro=true;
                    }


                    if ($formularioIngreso->isSubmitted() && $formularioIngreso->isValid()) {  
                           $datosIngreso = $formularioIngreso->getData();
                           $em = $this->getDoctrine()->getManager(); 
                           $query = $em->createQuery("SELECT c FROM BackendBundle:Cliente c WHERE c.usuario= :usuario  AND c.contrasenia=:contrasenia ");
                            $query->setParameter('usuario', $datosIngreso->getUsuario());
                            $query->setParameter('contrasenia', md5($datosIngreso->getContrasenia()));
                          
                           
                           $resultadoIngreso=$query->setMaxResults(1)->getOneOrNullResult();
                           if ($resultadoIngreso) {
                                    $session = new Session();
                                //si encontro registro en la session
                            if (!$this->container->get('session')->isStarted()) {
                                    $session->start();
                               }
                               $session->set('usuario',$resultadoIngreso->getUsuario() );
                               $session->set('contrasenia',$resultadoIngreso->getContrasenia() );
                                $session->set('clienteId',$resultadoIngreso->getId() );

                           }else{
                            $usuarioInvalido=true;
                           }
                        }elseif ($formularioIngreso->isSubmitted() && !$formularioIngreso->isValid()){
                                 $mostrarIngreso=true;
                        }

            return array('formularioRegistro'=>$formularioRegistro,'formularioIngreso'=>$formularioIngreso,'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido);

    }

     /**
     * @Route("/cerrarSesion" , name="cerrarSesion")
     */
    public function cerrarSesion(Request $request){
        // $session = new Session();
        // // $session->start();
        // //elimino la session
        // $session->remove('usuario');
        // $session->remove('contrasenia');
        // $session->remove('clienteId');
        // $session->invalidate();
        $this->get('session')->clear();
        $session = $this->get('session');
        $ses_vars = $session->all();
        foreach ($ses_vars as $key => $value) {
            $session->remove($key);
        }
        session_destroy();
        return $this->indexAction($request);

    }

}