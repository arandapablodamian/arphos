<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Actividad;
use BackendBundle\Form\ActividadType;
use MWSimple\Bundle\AdminCrudBundle\Controller\DefaultController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Form\ActividadFilterType;


/**
 * Actividad controller.
 * @author Nombre Apellido <name@gmail.com>
 *
 * @Route("actividad")
 */
class ActividadController extends Controller
{
    /**
     * Configuration file.
     */
    protected $config = [
        'yml' => 'BackendBundle/Resources/config/Actividad.yml',
    ];

    /**
     * Lists all Actividad entities.
     *
     * @Route("/", name="actividad")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $this->config['filterType'] = ActividadFilterType::class;
        $response = parent::indexAction($request);

        return $response;
    }

    /**
     * Creates a new Actividad entity.
     *
     * @Route("/", name="actividad_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $this->config['newType'] = ActividadType::class;
        $response = parent::createAction($request);

        return $response;
    }

    /**
     * Displays a form to create a new Actividad entity.
     *
     * @Route("/new", name="actividad_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $this->config['newType'] = ActividadType::class;
        $response = parent::newAction();

        return $response;
    }

    /**
     * Finds and displays a Actividad entity.
     *
     * @Route("/{id}", name="actividad_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $response = parent::showAction($id);

        return $response;
    }

    /**
     * Displays a form to edit an existing Actividad entity.
     *
     * @Route("/{id}/edit", name="actividad_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $this->config['editType'] = ActividadType::class;
        $response = parent::editAction($id);

        return $response;
    }

    /**
     * Edits an existing Actividad entity.
     *
     * @Route("/{id}", name="actividad_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $this->config['editType'] = ActividadType::class;
        $response = parent::updateAction($request, $id);

        return $response;
    }

    /**
     * Deletes a Actividad entity.
     *
     * @Route("/{id}", name="actividad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $response = parent::deleteAction($request, $id);

        return $response;
    }

    /**
     * Exporter Actividad.
     *
     * @Route("/exporter/{format}", name="actividad_export")
     */
    public function getExporter($format)
    {
        $response = parent::exportCsvAction($format);

        return $response;
    }
}
