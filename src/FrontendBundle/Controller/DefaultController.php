<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\DateInterval;
//para las entidades
use BackendBundle\Entity\Turno;
use BackendBundle\Entity\Cliente;
use BackendBundle\Entity\Category;
use BackendBundle\Entity\Mensaje;
use BackendBundle\Entity\Consulta;


//para los formularios
use FrontendBundle\Form\FormularioTurnoType;
use FrontendBundle\Form\FormularioContactoType;
use FrontendBundle\Form\FormularioRegistroType;
use FrontendBundle\Form\FormularioIngresoType;
use FrontendBundle\Form\FormularioMensajeType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//para la respuesta del json
use Symfony\Component\HttpFoundation\JsonResponse;




/**
     * @Route("/")
     */
class DefaultController extends Controller
{
    /**
     * @Route("/" , name="index")
     */
    public function indexAction(Request $request){

      //variables para el login
      $variablesLogin=$this->formularios($request);
      $formularioRegistro=$variablesLogin['formularioRegistro'];
      $formularioIngreso=$variablesLogin['formularioIngreso'];
      $mostrarRegistro=$variablesLogin['mostrarRegistro'];
      $mostrarIngreso=$variablesLogin['mostrarIngreso'];
      $usuarioInvalido=$variablesLogin['usuarioInvalido'];


      //en caso de que no solicite un turno, no muestra la ventanita de login 
      $pedirRegistroTurno=false;

      $turno = new Turno();
      $formularioTurno = $this->createForm(FormularioTurnoType::class, $turno);
      $formularioTurno->handleRequest($request);

      if ($formularioTurno->isSubmitted() && $formularioTurno->isValid()){
        //en caso de que el usuario no este logeado se deberia mostrar la pantall de logeo
        $session=$this->container->get('session');
        $clienteRegistrado =$session->get('clienteId');

        if ($session && $clienteRegistrado) {
            $datosTurno = $formularioTurno->getData();
            //guardo el turno en la base de datos
            $em = $this->getDoctrine()->getManager();

            //Creo un objeto de la clase Turno
            $turnoAlta = new Turno();

            //le asigno los campos que complete en el formulario
            $turnoAlta->setNombre($datosTurno->getNombre());
            $turnoAlta->setApellido($datosTurno->getApellido());
            $turnoAlta->setDireccion($datosTurno->getDireccion());
            $turnoAlta->setCorreo($datosTurno->getCorreo());
            $turnoAlta->setTelefono($datosTurno->getTelefono());
            $turnoAlta->setDiayhorapiso($datosTurno->getDiayhorapiso());
            $turnoAlta->setHora($datosTurno->getHora());

            //por defecto la hora techo se carga con una hora mas que la hora piso
            $auxDate= date_format($datosTurno->getHora(),'H:i');
            $turnoAlta->setHoratecho(\DateTime::createFromFormat('H:i',date('H:i',strtotime('+1 hour',strtotime($auxDate)))));
            //persisto el turno
            $em->persist($turnoAlta);

            //ejecuto la instrucción
            $em->flush();
        }else{
            //en caso de que no este el usuario registrado, pedir que se loguee
            $mostrarIngreso=true;
            //seteo el mensajito de se solicita loguearse para sacar turno en la ventanita de login
            $pedirRegistroTurno=true;

            //ahora redirigo al index
            return $this->render('FrontendBundle::index.html.twig',array(
        	'formularioTurno'=>$formularioTurno->createView(),
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido,'pedirRegistroTurno'=>$pedirRegistroTurno
        ));
            
        }
      }

        if (array_key_exists ('registroExitoso' ,$variablesLogin)) {
            return $this->render('FrontendBundle::registracion_exitosa.html.twig',array(
            'formularioTurno'=>$formularioTurno->createView(),
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
        }


        return $this->render('FrontendBundle::index.html.twig',array(
        	'formularioTurno'=>$formularioTurno->createView(),
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }

    public function registracionExitosaAction (Request $request){
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
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,
            'usuarioInvalido'=>$usuarioInvalido
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
                    $clienteAlta->setActivo(true);
                    $clienteAlta->setContrasenia(md5($datosCliente->getContrasenia()));
                    //persisto el cliente
                    $em->persist($clienteAlta);
                    //ejecuto la consulta
                    $em->flush();

                  return array('formularioRegistro'=>$formularioRegistro,'formularioIngreso'=>$formularioIngreso,'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido,'registroExitoso'=>true);


                    }elseif ($formularioRegistro->isSubmitted() && !$formularioRegistro->isValid()) {
                        $mostrarRegistro=true;
                    }


                    if ($formularioIngreso->isSubmitted() && $formularioIngreso->isValid()) {
                           $datosIngreso = $formularioIngreso->getData();
                           $em = $this->getDoctrine()->getManager();
                           $query = $em->createQuery("SELECT c FROM BackendBundle:Cliente c WHERE c.usuario= :usuario  AND c.contrasenia=:contrasenia and c.activo= 1 ");
                            $query->setParameter('usuario', $datosIngreso->getUsuario());
                            $query->setParameter('contrasenia', md5($datosIngreso->getContrasenia()));


                           $resultadoIngreso=$query->setMaxResults(1)->getOneOrNullResult();
                           if ($resultadoIngreso) {

                                //si encontro registro en la session
                            if (!$this->container->get('session')->isStarted()) {   
                                $session = new Session();
                                $session->start();

                               }else {
                                $session=$this->container->get('session');

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
          return $this->redirectToRoute('index');

    }


     /**
     * @Route("/editarPerfil" , name="editarPerfil")
     */
    public function editarPerfilAction(Request $request)
    {
        //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=false;
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        $cliente = new Cliente();
        $formularioEditar = $this->createFormBuilder($cliente)
                        ->add('direccion',null,array( 'label' => 'Dirección'))
                         ->add('telefono',null,array('label' => 'Teléfono'))
                        ->add('email',EmailType::class, [
                            'label' => 'Email'
                        ])
                        ->add('contrasenia',PasswordType::class, [
                            'label' => 'Contraseña',
                            'attr'=>[
                            ]
                        ])
                        ->add('resetearContrasenia', ChoiceType::class, array(
                         'label'=>'Resetear Contraseña',
                        'mapped'=>false,
                        'choices'  => array(
                            'No' => false,
                            'Si' => true,)
                       ))
                        ->add('enviar', SubmitType::class, array(
                            'label' => 'Confirmar','attr'=>['class'=>'btn-success'],
                        ))
                        ->getForm();
         //busco el cliente con el id de sesion que guarde
        $session=$this->container->get('session');
        $em = $this->getDoctrine()->getManager();
        $clienteEditar = $em->getRepository(Cliente::class)->find($session->get('clienteId'));

        if (!$clienteEditar) {
            throw $this->createNotFoundException(
            'Error, el cliente no fue encontrado '.$session->get('clienteId'));
            }else{
            //establesco los valores del cliente en el form
                $formularioEditar->get('direccion')->setData($clienteEditar->getDireccion());
                $formularioEditar->get('telefono')->setData($clienteEditar->getTelefono());
                $formularioEditar->get('email')->setData($clienteEditar->getEmail());
                $formularioEditar->get('contrasenia')->setData($clienteEditar->getContrasenia());

            }
        //ahora trato el formulario

        $formularioEditar->handleRequest($request);

            if ($formularioEditar->isSubmitted() && $formularioEditar->isValid()) {
                //obtengo los datos del cliente

                $datosCliente = $formularioEditar->getData();


                    $clienteEditar->setEmail($datosCliente->getEmail());
                    $clienteEditar->setDireccion($datosCliente->getDireccion());
                    $clienteEditar->setTelefono($datosCliente->getTelefono());

                    // me fijo si eligio una nueva contraseña
                    if ($datosCliente->getContrasenia()!=null and $datosCliente->getContrasenia()!='') {
                        $clienteEditar->setContrasenia(md5($datosCliente->getContrasenia()));
                    }

                    //guardo el cliente en la base de datos
                    $em->flush();

                    //elimino la session
                     $this->get('session')->clear();
                    $session = $this->get('session');
                    $ses_vars = $session->all();
                    foreach ($ses_vars as $key => $value) {
                        $session->remove($key);
                    }
                    session_destroy();

                    //redirecciono a la vista
                     return $this->render('FrontendBundle::edicion_exitosa.html.twig',array(
                    'formularioEditar'=>$formularioEditar->createView(),
                    'formularioRegistro'=>$formularioRegistro->createView(),
                    'formularioIngreso'=> $formularioIngreso->createView(),
                    'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido));


                    }elseif ($formularioRegistro->isSubmitted() && !$formularioRegistro->isValid()) {
                        return $this->render('FrontendBundle::editarPerfil.html.twig',array(
                            'formularioEditar'=>$formularioEditar->createView(),
                            'formularioRegistro'=>$formularioRegistro->createView(),
                            'formularioIngreso'=> $formularioIngreso->createView(),
                            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
                        ));
                    }

        return $this->render('FrontendBundle::editarPerfil.html.twig',array(
            'formularioEditar'=>$formularioEditar->createView(),
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }




    /**
     * @Route("/verCarrito", name="verCarrito")
     */
    public function verCarritoAction(Request $request)
    {
         //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        return $this->render('FrontendBundle::verCarrito.html.twig',array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }

      /**
     * @Route("/verCompras", name="verCompras")
     */
    public function verComprasAction(Request $request)
    {
         //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        return $this->render('FrontendBundle::verCompras.html.twig',array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }

     /**
     * @Route("/verMensajes", name="verMensajes")
     */
    public function verMensajesAction(Request $request)
    {
         //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        //obtengo el id del usuario
        $session=$this->container->get('session');
        $clienteId=$session->get('clienteId');
        //obtengo los mensajes del usuario
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT c FROM BackendBundle:Consulta c WHERE c.cliente =:clienteId");
        $query->setParameter('clienteId', $clienteId);
        $mensajes = $query->getResult();

        //ahora obtengo el formulario para crear el mensaje
        $mensaje = new Consulta();
        $formularioMensaje = $this->createForm(FormularioMensajeType::class, $mensaje);
        $formularioMensaje->handleRequest($request);

        if ($formularioMensaje->isSubmitted() && $formularioMensaje->isValid()) {
                $datosMensaje = $formularioMensaje->getData();

                    //guardo el mensaje la base de datos
                    $em = $this->getDoctrine()->getManager();
                    //creo una clase cliente
                    $mensaje = new Consulta();
                    //le asigno los campos que complete en en formulario de registros
                     $query = $em->createQuery("SELECT c FROM BackendBundle:Cliente c WHERE c.id =:idCliente");
                    $query->setParameter('idCliente', $clienteId);
                    $cliente=$query->getOneOrNullResult();

                    //creo el mensaje
                    $mensaje->setCliente($cliente);
                    $mensaje->setEstado(false);
                    $mensaje->setFechaCreacion(new \DateTime("now"));
                    $mensaje->setMensaje($datosMensaje->getMensaje());

                    //persisto el cliente
                    $em->persist($mensaje);
                    //ejecuto la consulta
                    $em->flush();



                     return $this->render('FrontendBundle::mensaje_exitoso.html.twig',array(
                'formularioRegistro'=>$formularioRegistro->createView(),
                'formularioIngreso'=> $formularioIngreso->createView(),
                'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido));
                    }


        return $this->render('FrontendBundle::verMensajes.html.twig',array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido,'formularioMensaje'=>$formularioMensaje->createView(),'mensajes'=>$mensajes
        ));
    }



       /**
     * @Route("/verTurnos", name="verTurnos")
     */
    public function verTurnosAction(Request $request)
    {
         //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];

        return $this->render('FrontendBundle::verTurnos.html.twig',array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido
        ));
    }

      /**
     * @Route("/buscarUsuario/{usuario}", name="buscarUsuario", methods={"POST"})
     */
    public function buscarUsuarioAction($usuario)
    {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT c FROM BackendBundle:Cliente c WHERE c.usuario =:usuario");
        $query->setParameter('usuario', $usuario);

        $busquedaUsuario=$query->getOneOrNullResult();
        if ($busquedaUsuario!=null) {
            $resultado='encontro';
        }else{
            $resultado='noencontro';
        }

        return new JsonResponse($resultado);
    }

    /**
     * @Route("/obtenerTurnoDisponible/{fecha}/{hora}/{minuto}", name="obtenerTurnoDisponible")
     */
    public function obtenerTurnoDisponibleAction($fecha, $hora, $minuto){



      $em = $this->getDoctrine()->getManager();
      $query = $em->createQuery("SELECT t.hora FROM BackendBundle:Turno t WHERE t.diayhorapiso =:fecha and :hora >= t.hora and :hora <= t.horatecho");
      $query->setParameter('fecha', $fecha);
      $query->setParameter('hora', $hora.":".$minuto);

      $turnosOcupados = $query->getResult();

      return new JsonResponse($turnosOcupados);
    }


}
