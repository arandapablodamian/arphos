<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FrontendBundle\Entity\ProductoComprado;
use BackendBundle\Entity\Category;
use FrontendBundle\Form\ProductoCompradoType;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


use FrontendBundle\Entity\MP;

class TiendaController extends Controller
{
     /**
     * @Route("/tienda", name="tienda")
     */
    public function tiendaAction()
    {
        $Categorias = $this -> getDoctrine()
        ->getRepository("BackendBundle:Categoria")
        -> findall();
        $Productos = $this -> getDoctrine()
        ->getRepository("BackendBundle:Producto")
        -> findall();
        $Estaciones = $this -> getDoctrine()
        ->getRepository("BackendBundle:Estacion")
        -> findall();

        return $this->render('FrontendBundle::tienda.html.twig', array("Categorias" => $Categorias, "Productos" => $Productos,
            "Estaciones" => $Estaciones));
    }
     /**
     * @Route("/tiendaproducto-{id}", name="tiendaproducto")
     */
    public function tiendaproductoAction($id,Request $request)
    {
        $Categorias = $this -> getDoctrine()
        ->getRepository("BackendBundle:Categoria")
        -> findall();
        $Estaciones = $this -> getDoctrine()
        ->getRepository("BackendBundle:Estacion")
        -> findall();
        $Producto = $this -> getDoctrine()
        ->getRepository("BackendBundle:Producto")
        ->find($id);

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

        return $this->render('FrontendBundle::tiendaproducto.html.twig', array("Categorias" => $Categorias,
            "Estaciones" => $Estaciones, "Producto" => $Producto, 'form' => $Productoform->createView()));
    }
     /**
     * @Route("/carrito", name="carrito")
     */
    public function carritoAction(Request $request)
    {   
        $session = $request->getSession();
        $session->start();
        $Categorias = $this -> getDoctrine()
        ->getRepository("BackendBundle:Categoria")
        -> findall();
        $Estaciones = $this -> getDoctrine()
        ->getRepository("BackendBundle:Estacion")
        -> findall();
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


            $id=0;
            $Items= array();
            foreach ($ProductosComprados as $Comprado) {
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

            $nombres = "";
            foreach ($ProductosComprados as $Comprado) {
           $nombres= $nombres . $Comprado ->getNombre() . " x" . $Comprado ->getCantidad() . " ,";
            };
            $Items[0]["title"] = $nombres;

                        $preference_data = array();
                        $preference_data["items"] = $Items;

                $preference = $mp->create_preference($preference_data);
                return $this->redirect($preference['response']['init_point']);
          
         }

        return $this->render('FrontendBundle::carrito.html.twig', array("Categorias" => $Categorias,
            "Estaciones" => $Estaciones,"Comprados" => $ProductosComprados, 'form' => $form->createView()));
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

}