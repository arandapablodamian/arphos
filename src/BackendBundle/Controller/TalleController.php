<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Talle;
use BackendBundle\Form\TalleType;
use MWSimple\Bundle\AdminCrudBundle\Controller\DefaultController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Form\TalleFilterType;


/**
 * Talle controller.
 * @author Nombre Apellido <name@gmail.com>
 *
 * @Route("talle")
 */
class TalleController extends Controller
{
    /**
     * Configuration file.
     */
    protected $config = [
        'yml' => 'BackendBundle/Resources/config/Talle.yml',
    ];

    /**
     * Lists all Talle entities.
     *
     * @Route("/", name="talle")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $this->config['filterType'] = TalleFilterType::class;
        $response = parent::indexAction($request);

        return $response;
    }

    /**
     * Creates a new Talle entity.
     *
     * @Route("/", name="talle_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $this->config['newType'] = TalleType::class;
        $response = parent::createAction($request);

        return $response;
    }

    /**
     * Displays a form to create a new Talle entity.
     *
     * @Route("/new", name="talle_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $this->config['newType'] = TalleType::class;
        $response = parent::newAction();

        return $response;
    }

    /**
     * Finds and displays a Talle entity.
     *
     * @Route("/{id}", name="talle_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $response = parent::showAction($id);

        return $response;
    }

    /**
     * Displays a form to edit an existing Talle entity.
     *
     * @Route("/{id}/edit", name="talle_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $this->config['editType'] = TalleType::class;
        $response = parent::editAction($id);

        return $response;
    }

    /**
     * Edits an existing Talle entity.
     *
     * @Route("/{id}", name="talle_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $this->config['editType'] = TalleType::class;
        $response = parent::updateAction($request, $id);

        return $response;
    }

    /**
     * Deletes a Talle entity.
     *
     * @Route("/{id}", name="talle_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $response = parent::deleteAction($request, $id);

        return $response;
    }

    /**
     * Exporter Talle.
     *
     * @Route("/exporter/{format}", name="talle_export")
     */
    public function getExporter($format)
    {
        $response = parent::exportCsvAction($format);

        return $response;
    }
}
