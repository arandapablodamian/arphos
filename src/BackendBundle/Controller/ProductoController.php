<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Producto;
use BackendBundle\Form\ProductoType;
use MWSimple\Bundle\AdminCrudBundle\Controller\DefaultController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Form\ProductoFilterType;


/**
 * Producto controller.
 * @author Nombre Apellido <name@gmail.com>
 *
 * @Route("producto")
 */
class ProductoController extends Controller
{
    /**
     * Configuration file.
     */
    protected $config = [
        'yml' => 'BackendBundle/Resources/config/Producto.yml',
    ];

    /**
     * Lists all Producto entities.
     *
     * @Route("/", name="producto")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $this->config['filterType'] = ProductoFilterType::class;
        $response = parent::indexAction($request);

        return $response;
    }

    /**
     * Creates a new Producto entity.
     *
     * @Route("/", name="producto_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $this->config['newType'] = ProductoType::class;
        $response = parent::createAction($request);

        return $response;
    }

    /**
     * Displays a form to create a new Producto entity.
     *
     * @Route("/new", name="producto_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $this->config['newType'] = ProductoType::class;
        $response = parent::newAction();

        return $response;
    }

    /**
     * Finds and displays a Producto entity.
     *
     * @Route("/{id}", name="producto_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $response = parent::showAction($id);

        return $response;
    }

    /**
     * Displays a form to edit an existing Producto entity.
     *
     * @Route("/{id}/edit", name="producto_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $this->config['editType'] = ProductoType::class;
        $response = parent::editAction($id);

        return $response;
    }

    /**
     * Edits an existing Producto entity.
     *
     * @Route("/{id}", name="producto_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $this->config['editType'] = ProductoType::class;
        $response = parent::updateAction($request, $id);

        return $response;
    }

    /**
     * Deletes a Producto entity.
     *
     * @Route("/{id}", name="producto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $response = parent::deleteAction($request, $id);

        return $response;
    }

    /**
     * Exporter Producto.
     *
     * @Route("/exporter/{format}", name="producto_export")
     */
    public function getExporter($format)
    {
        $response = parent::exportCsvAction($format);

        return $response;
    }

    /**
     * Autocomplete a Producto entity.
     *
     * @Route("/autocomplete-forms/get-categorias", name="producto_autocomplete_categorias")
     */
    public function getAutocompleteCategorias(Request $request)
    {
        $options = [
            'repository' => "BackendBundle:Categoria",
            'field'      => "id",
        ];
        $response = parent::getAutocompleteFormsMwsAction($request, $options);

        return $response;
    }

    /**
     * Autocomplete a Producto entity.
     *
     * @Route("/autocomplete-forms/get-resources", name="producto_autocomplete_resources")
     */
    public function getAutocompleteResources(Request $request)
    {
        $options = [
            'repository' => "BackendBundle:Resource",
            'field'      => "id",
        ];
        $response = parent::getAutocompleteFormsMwsAction($request, $options);

        return $response;
    }
}
