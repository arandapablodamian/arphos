<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Categoria;
use BackendBundle\Form\CategoriaType;
use MWSimple\Bundle\AdminCrudBundle\Controller\DefaultController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Form\CategoriaFilterType;


/**
 * Categorium controller.
 * @author Nombre Apellido <name@gmail.com>
 *
 * @Route("categoria")
 */
class CategoriaController extends Controller
{
    /**
     * Configuration file.
     */
    protected $config = [
        'yml' => 'BackendBundle/Resources/config/Categoria.yml',
    ];

    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="categoria")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $this->config['filterType'] = CategoriaFilterType::class;
        $response = parent::indexAction($request);

        return $response;
    }

    /**
     * Creates a new Categoria entity.
     *
     * @Route("/", name="categoria_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $this->config['newType'] = CategoriaType::class;
        $response = parent::createAction($request);

        return $response;
    }

    /**
     * Displays a form to create a new Categoria entity.
     *
     * @Route("/new", name="categoria_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $this->config['newType'] = CategoriaType::class;
        $response = parent::newAction();

        return $response;
    }

    /**
     * Finds and displays a Categoria entity.
     *
     * @Route("/{id}", name="categoria_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $response = parent::showAction($id);

        return $response;
    }

    /**
     * Displays a form to edit an existing Categoria entity.
     *
     * @Route("/{id}/edit", name="categoria_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $this->config['editType'] = CategoriaType::class;
        $response = parent::editAction($id);

        return $response;
    }

    /**
     * Edits an existing Categoria entity.
     *
     * @Route("/{id}", name="categoria_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $this->config['editType'] = CategoriaType::class;
        $response = parent::updateAction($request, $id);

        return $response;
    }

    /**
     * Deletes a Categoria entity.
     *
     * @Route("/{id}", name="categoria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $response = parent::deleteAction($request, $id);

        return $response;
    }

    /**
     * Exporter Categoria.
     *
     * @Route("/exporter/{format}", name="categoria_export")
     */
    public function getExporter($format)
    {
        $response = parent::exportCsvAction($format);

        return $response;
    }

    /**
     * Autocomplete a Categoria entity.
     *
     * @Route("/autocomplete-forms/get-subcategorias", name="categoria_autocomplete_subcategorias")
     */
    public function getAutocompleteSubcategorias(Request $request)
    {
        $options = [
            'repository' => "BackendBundle:Categoria",
            'field'      => "id",
        ];
        $response = parent::getAutocompleteFormsMwsAction($request, $options);

        return $response;
    }

    /**
     * Autocomplete a Categoria entity.
     *
     * @Route("/autocomplete-forms/get-categoriapadre", name="categoria_autocomplete_categoriapadre")
     */
    public function getAutocompleteCategoriapadre(Request $request)
    {
        $options = [
            'repository' => "BackendBundle:Categoria",
            'field'      => "id",
        ];
        $response = parent::getAutocompleteFormsMwsAction($request, $options);

        return $response;
    }

    /**
     * Autocomplete a Categoria entity.
     *
     * @Route("/autocomplete-forms/get-productos", name="categoria_autocomplete_productos")
     */
    public function getAutocompleteProductos(Request $request)
    {
        $options = [
            'repository' => "BackendBundle:Producto",
            'field'      => "id",
        ];
        $response = parent::getAutocompleteFormsMwsAction($request, $options);

        return $response;
    }
}
