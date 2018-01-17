<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Estacion;
use BackendBundle\Form\EstacionType;
use MWSimple\Bundle\AdminCrudBundle\Controller\DefaultController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Form\EstacionFilterType;


/**
 * Estacion controller.
 * @author Nombre Apellido <name@gmail.com>
 *
 * @Route("estacion")
 */
class EstacionController extends Controller
{
    /**
     * Configuration file.
     */
    protected $config = [
        'yml' => 'BackendBundle/Resources/config/Estacion.yml',
    ];

    /**
     * Lists all Estacion entities.
     *
     * @Route("/", name="estacion")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $this->config['filterType'] = EstacionFilterType::class;
        $response = parent::indexAction($request);

        return $response;
    }

    /**
     * Creates a new Estacion entity.
     *
     * @Route("/", name="estacion_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $this->config['newType'] = EstacionType::class;
        $response = parent::createAction($request);

        return $response;
    }

    /**
     * Displays a form to create a new Estacion entity.
     *
     * @Route("/new", name="estacion_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $this->config['newType'] = EstacionType::class;
        $response = parent::newAction();

        return $response;
    }

    /**
     * Finds and displays a Estacion entity.
     *
     * @Route("/{id}", name="estacion_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $response = parent::showAction($id);

        return $response;
    }

    /**
     * Displays a form to edit an existing Estacion entity.
     *
     * @Route("/{id}/edit", name="estacion_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $this->config['editType'] = EstacionType::class;
        $response = parent::editAction($id);

        return $response;
    }

    /**
     * Edits an existing Estacion entity.
     *
     * @Route("/{id}", name="estacion_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $this->config['editType'] = EstacionType::class;
        $response = parent::updateAction($request, $id);

        return $response;
    }

    /**
     * Deletes a Estacion entity.
     *
     * @Route("/{id}", name="estacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $response = parent::deleteAction($request, $id);

        return $response;
    }

    /**
     * Exporter Estacion.
     *
     * @Route("/exporter/{format}", name="estacion_export")
     */
    public function getExporter($format)
    {
        $response = parent::exportCsvAction($format);

        return $response;
    }
}
