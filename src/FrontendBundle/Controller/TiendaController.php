<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FrontendBundle\Entity\ProductoComprado;
use BackendBundle\Entity\Category;
use FrontendBundle\Form\ProductoCompradoType;
use BackendBundle\Entity\Compra;
use BackendBundle\Entity\Resource;
use Symfony\Component\HttpFoundation\Session\Session;
use BackendBundle\Entity\Turno;
use BackendBundle\Entity\Cliente;
use BackendBundle\Entity\Mensaje;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

//para los formularios
use FrontendBundle\Form\FormularioTurnoType;
use FrontendBundle\Form\FormularioContactoType;
use FrontendBundle\Form\FormularioRegistroType;
use FrontendBundle\Form\FormularioIngresoType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
//para la respuesta del json
use Symfony\Component\HttpFoundation\JsonResponse;

use FrontendBundle\Entity\MP;

class TiendaController extends Controller
{
     /**
     * @Route("/tienda", name="tienda")
     */
    public function tiendaAction(Request $request)
    {
        //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];
        ///
        $Categorias = $this -> getDoctrine()
        ->getRepository("BackendBundle:Categoria")
        -> findall();
        $Productos = $this -> getDoctrine()
        ->getRepository("BackendBundle:Producto")
        -> findall();
        /*$Estaciones = $this -> getDoctrine()
        ->getRepository("BackendBundle:Estacion")
        -> findall();
        */
        return $this->render('FrontendBundle::tienda.html.twig', array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido,
        "Categorias" => $Categorias, "Productos" => $Productos/*,
            "Estaciones" => $Estaciones*/));
    }
     /**
     * @Route("/tiendacategoria={categoria}", name="tiendacategoria")
     */
    public function tiendaCategoriaAction($categoria, Request $request)
    {   
         //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];
        ///
        $Categorias = $this -> getDoctrine()
        ->getRepository("BackendBundle:Categoria")
        -> findall();
        $Productos = $this -> getDoctrine()
        ->getRepository("BackendBundle:Producto")
        -> findall();
        
        $CatElegida = $this->getDoctrine()->getRepository('BackendBundle:Categoria')->find($categoria);
        $Productos= array_filter($Productos, function($i) use($CatElegida) {
                if ($i->getCategorias() ->contains($CatElegida)) {
                    return true;    
                }
                return false;
            });;

       /*$Estaciones = $this -> getDoctrine()
        ->getRepository("BackendBundle:Estacion")
        -> findall();
        */
        return $this->render('FrontendBundle::tienda.html.twig', array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido,
            "Categorias" => $Categorias, "Productos" => $Productos,
           /* "Estaciones" => $Estaciones,*/ "Categoria" => $categoria));
    }
     /**
     * @Route("/tiendacolor={color}", name="tiendacolor")
     */
    public function tiendaColorAction($color, Request $request)
    {
        //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];
        ///
        $Categorias = $this -> getDoctrine()
        ->getRepository("BackendBundle:Categoria")
        -> findall();
        $Productos = $this -> getDoctrine()
        ->getRepository("BackendBundle:Producto")
        -> findall();
        
        //$CatElegida = $this->getDoctrine()->getRepository('BackendBundle:Categoria')->find($categoria);
        $Productos= array_filter($Productos, function($i) use($color) {
                if ($i->getColor() == $color) {
                    return true;    
                }
                return false;
            });;

       /*$Estaciones = $this -> getDoctrine()
        ->getRepository("BackendBundle:Estacion")
        -> findall();
        */
        return $this->render('FrontendBundle::tienda.html.twig', array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido,
            "Categorias" => $Categorias, "Productos" => $Productos,
           /* "Estaciones" => $Estaciones,*/ "Color" => $color));
    }
     /**
     * @Route("/tiendaproducto-{id}", name="tiendaproducto")
     */
    public function tiendaproductoAction($id,Request $request)
    {
        //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];
        ///
        $Categorias = $this -> getDoctrine()
        ->getRepository("BackendBundle:Categoria")
        -> findall();
        /*
        $Estaciones = $this -> getDoctrine()
        ->getRepository("BackendBundle:Estacion")
        -> findall();
        */
        $Producto = $this -> getDoctrine()
        ->getRepository("BackendBundle:Producto")
        ->find($id);

        $Categorias = $Producto -> getCategorias();

        $Imagenes = $this -> getDoctrine()
        ->getRepository("BackendBundle:Resource")
        //-> findall();
        -> findBy(array('producto' => $Producto->getId() ));

        /*Esta parte aca me volvio loco, y estoy seguro que es la peor forma de hacerlo */
        $TallesId=$Producto-> getTalles();
        $Talles = array();
        foreach ($TallesId as $talleid) {
            $Talle = $this -> getDoctrine()
            ->getRepository("BackendBundle:Talle")
            ->find($talleid);
            $TalleNombre= $Talle -> getNombre();
            $Talles[$TalleNombre] = $TalleNombre;
        };
        /*Esta parte aca me volvio loco, y estoy seguro que es la peor forma de hacerlo */ 
        $session = $request->getSession();
        $session->start();

        $ProductoComprado = new ProductoComprado();
        $Productoform = $this->createFormBuilder($ProductoComprado)
            ->add('session', HiddenType::class, array('empty_data' => $session->getId(),))
            ->add('nombre', HiddenType::class, array('empty_data' => $Producto -> getNombre() ,))
            ->add('cantidad', IntegerType::class, array('data' => 1,'data' => 1))
            ->add('precio', HiddenType::class, array('empty_data' => $Producto -> getPrecio() ,))
            ->add('talle', ChoiceType::class, array( 'choices'  => $Talles ))
            ->add('save', SubmitType::class, array('label' => 'Cargar a Carrito'))
            ->getForm();
        $Productoform->handleRequest($request);

        if ($Productoform->isSubmitted() && $Productoform->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $ProductoComprado = $Productoform->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($ProductoComprado);
         $entityManager->flush();
    }

        return $this->render('FrontendBundle::tiendaproducto.html.twig', array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido,
            "Categorias" => $Categorias,
            /*"Estaciones" => $Estaciones,*/"Imagenes" => $Imagenes, "Categorias" => $Categorias, "Producto" => $Producto, 'form' => $Productoform->createView()));
    }
     /**
     * @Route("/carrito", name="carrito")
     */
    public function carritoAction(Request $request)
    {   
        //variables para el login
        $variablesLogin=$this->formularios($request);
        $formularioRegistro=$variablesLogin['formularioRegistro'];
        $formularioIngreso=$variablesLogin['formularioIngreso'];
        $mostrarRegistro=$variablesLogin['mostrarRegistro'];
        $mostrarIngreso=$variablesLogin['mostrarIngreso'];
        $usuarioInvalido=$variablesLogin['usuarioInvalido'];
        ///
        $session = $request->getSession();
        $session->start();
        $Categorias = $this -> getDoctrine()
        ->getRepository("BackendBundle:Categoria")
        -> findall();
        /*
        $Estaciones = $this -> getDoctrine()
        ->getRepository("BackendBundle:Estacion")
        -> findall();
        */
         $ProductosComprados = $this -> getDoctrine()
        ->getRepository("FrontendBundle:ProductoComprado")
        -> findBy(array('session' => $session->getId() ));

        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
        ->add('send', SubmitType::class,array('label' => 'Ir a las opciones de pago y envio'))
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
                $mp = new MP('1196810826207782', 'TDxXTGPlWXvUxNfLRY1coWmB9L8zd2gw');

                //creamos la compra
                    $Compra = new Compra();
                    $montototal = 0;
                //hasta aca

                
            $id=0;
            $Items= array();
            foreach ($ProductosComprados as $Comprado) {
                //para la compra en el loop
                $montototal = $montototal + intval($Comprado ->getPrecio()) * intval($Comprado ->getCantidad());
                $Compra ->addProducto($Comprado);
                //hasta aca
                $id++;
                $DatosProducto =  array(
                    "id" => $id,
           "title" => $Comprado ->getNombre(),
           "quantity" => intval($Comprado ->getCantidad()),
           "currency_id" => "ARS",
           "unit_price" => intval($Comprado ->getPrecio())
                );
                array_push($Items, $DatosProducto);
            }; 

            //esta parte es para cargar la compra
                
                $Compra ->setFechaCompra(new \DateTime());
                
                $Compra ->setMontoTotal($montototal);
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($Compra);
                $entityManager->flush();

            //hasta aca

            $nombres = "";
            foreach ($ProductosComprados as $Comprado) {
           $nombres= $nombres . $Comprado ->getNombre(). " " . $Comprado ->getTalle() . " x" . $Comprado ->getCantidad() . " ,";
            };
            $Items[0]["title"] = $nombres;

                        $preference_data = array();
                        $preference_data["items"] = $Items;

                $preference = $mp->create_preference($preference_data);
                return $this->redirect($preference['response']['init_point']);
          
         }

        return $this->render('FrontendBundle::carrito.html.twig', array(
            'formularioRegistro'=>$formularioRegistro->createView(),
            'formularioIngreso'=> $formularioIngreso->createView(),
            'mostrarRegistro'=>$mostrarRegistro,'mostrarIngreso'=>$mostrarIngreso,'usuarioInvalido'=>$usuarioInvalido,
            "Categorias" => $Categorias,
           /* "Estaciones" => $Estaciones,*/"Comprados" => $ProductosComprados, 'form' => $form->createView()));
    }
     /**
     * @Route("/borrarproducto-{id}", name="borrarproducto")
     */
    public function borrarproducto($id)
    {   
        $ProductoComprado = $this -> getDoctrine()
        ->getRepository("FrontendBundle:ProductoComprado")
        ->find($id);
         $em = $this->getDoctrine()->getManager(); 
         $em->remove($ProductoComprado); 
         $em->flush();

       $response = $this->forward('FrontendBundle:Tienda:carrito', array(
        ));

        return $response;
    }
     /**
     * @Route("/arreglo", name="arreglo")
     */
    public function arreglo()
    {   
        
      return $this->render('FrontendBundle::arreglo.html.twig', array());
    }

    public function formularios (Request $request){
        $turno = new Turno();
        $formularioTurno = $this->createForm(FormularioTurnoType::class, $turno);

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
                                    
                                //si encontro registro en la session
                            if (!$this->container->get('session')->isStarted()) {   $session = new Session();
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

}