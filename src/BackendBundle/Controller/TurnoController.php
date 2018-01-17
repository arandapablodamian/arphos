<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Turno;
use BackendBundle\Form\TurnoType;
use MWSimple\Bundle\AdminCrudBundle\Controller\DefaultController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Form\TurnoFilterType;


/**
 * Turno controller.
 * @author Nombre Apellido <name@gmail.com>
 *
 * @Route("turno")
 */
class TurnoController extends Controller
{
    /**
     * Configuration file.
     */
    protected $config = [
        'yml' => 'BackendBundle/Resources/config/Turno.yml',
    ];

    /**
     * Lists all Turno entities.
     *
     * @Route("/", name="turno")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $this->config['filterType'] = TurnoFilterType::class;
        $response = parent::indexAction($request);

        return $response;
    }

    /**
     * Creates a new Turno entity.
     *
     * @Route("/", name="turno_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $this->config['newType'] = TurnoType::class;
        $response = parent::createAction($request);

        return $response;
    }

    /**
     * Displays a form to create a new Turno entity.
     *
     * @Route("/new", name="turno_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $this->config['newType'] = TurnoType::class;
        $response = parent::newAction();

        return $response;
    }

    /**
     * Finds and displays a Turno entity.
     *
     * @Route("/{id}", name="turno_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $response = parent::showAction($id);

        return $response;
    }

    /**
     * Displays a form to edit an existing Turno entity.
     *
     * @Route("/{id}/edit", name="turno_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $this->config['editType'] = TurnoType::class;
        $response = parent::editAction($id);

        return $response;
    }

    /**
     * Edits an existing Turno entity.
     *
     * @Route("/{id}", name="turno_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $this->config['editType'] = TurnoType::class;
        $response = parent::updateAction($request, $id);

        return $response;
    }

    /**
     * Deletes a Turno entity.
     *
     * @Route("/{id}", name="turno_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $response = parent::deleteAction($request, $id);

        return $response;
    }

    /**
     * Exporter Turno.
     *
     * @Route("/exporter/{format}", name="turno_export")
     */
    public function getExporter($format)
    {
        $response = parent::exportCsvAction($format);

        return $response;
    }
}
