<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensaje
 *
 * @ORM\Table(name="consulta")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\ConsultaRepository")
 */
class Consulta
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     *@ORM\ManyToOne(targetEntity="\BackendBundle\Entity\Cliente")
     *@ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    private $cliente;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="mensaje", type="text")
     */
    private $mensaje;


    /**
     * @var string
     *
     * @ORM\Column(name="respuesta", type="text", nullable=true)
     */
    private $respuesta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaContestacion", type="datetime", nullable=true)
     */
    private $fechaContestacion;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cliente
     *
     * @param string $cliente
     *
     * @return Cliente
     */
    public function setCliente(\BackendBundle\Entity\Cliente $cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return string
     */
    public function getCliente()
    {
        return $this->cliente;
    }



    /**
     * Set nombre
     *
     * @param boolean $estado
     *
     * @return Consulta
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }



    /**
     * Set nombre
     *
     * @param string $mensaje
     *
     * @return Mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }


    /**
     * Set respuesta
     *
     * @param string $respuesta
     *
     * @return Consulta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }



        /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Producto
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

       /**
     * Set fechaContestacion
     *
     * @param \DateTime $fechaContestacion
     *
     * @return Consulta
     */
    public function setFechaContestacion($fechaContestacion)
    {
        $this->fechaContestacion = $fechaContestacion;

        return $this;
    }

    /**
     * Get fechaContestacion
     *
     * @return \DateTime
     */
    public function getFechaContestacion()
    {
        return $this->fechaContestacion;
    }
}

