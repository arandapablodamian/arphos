<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Mensaje;
use BackendBundle\Form\MensajeType;
use MWSimple\Bundle\AdminCrudBundle\Controller\DefaultController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Form\MensajeFilterType;


/**
 * Mensaje controller.
 * @author Nombre Apellido <name@gmail.com>
 *
 * @Route("mensaje")
 */
class MensajeController extends Controller
{
    /**
     * Configuration file.
     */
    protected $config = [
        'yml' => 'BackendBundle/Resources/config/Mensaje.yml',
    ];

    /**
     * Lists all Mensaje entities.
     *
     * @Route("/", name="mensaje")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $this->config['filterType'] = MensajeFilterType::class;
        $response = parent::indexAction($request);

        return $response;
    }

    /**
     * Creates a new Mensaje entity.
     *
     * @Route("/", name="mensaje_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $this->config['newType'] = MensajeType::class;
        $response = parent::createAction($request);

        return $response;
    }

    /**
     * Displays a form to create a new Mensaje entity.
     *
     * @Route("/new", name="mensaje_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $this->config['newType'] = MensajeType::class;
        $response = parent::newAction();

        return $response;
    }

    /**
     * Finds and displays a Mensaje entity.
     *
     * @Route("/{id}", name="mensaje_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $response = parent::showAction($id);

        return $response;
    }

    /**
     * Displays a form to edit an existing Mensaje entity.
     *
     * @Route("/{id}/edit", name="mensaje_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $this->config['editType'] = MensajeType::class;
        $response = parent::editAction($id);

        return $response;
    }

    /**
     * Edits an existing Mensaje entity.
     *
     * @Route("/{id}", name="mensaje_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $this->config['editType'] = MensajeType::class;
        $response = parent::updateAction($request, $id);

        return $response;
    }

    /**
     * Deletes a Mensaje entity.
     *
     * @Route("/{id}", name="mensaje_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $response = parent::deleteAction($request, $id);

        return $response;
    }

    /**
     * Exporter Mensaje.
     *
     * @Route("/exporter/{format}", name="mensaje_export")
     */
    public function getExporter($format)
    {
        $response = parent::exportCsvAction($format);

        return $response;
    }
}
