<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Turno
 *
 * @ORM\Table(name="turno")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\TurnoRepository")
 */
class Turno
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255)
     */
    private $correo;

    /**
     * @var int
     *
     * @ORM\Column(name="telefono", type="bigint")
     */
    private $telefono;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="diayhorapiso", type="datetime")
     */
    private $diayhorapiso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="diayhoratecho", type="datetime")
     */
    private $diayhoratecho;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Turno
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Turno
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Turno
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

     /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Turno
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     *
     * @return Turno
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return int
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set diayhorapiso
     *
     * @param \DateTime $diayhorapiso
     *
     * @return Turno
     */
    public function setDiayhorapiso($diayhorapiso)
    {
        $this->diayhorapiso = $diayhorapiso;

        return $this;
    }

    /**
     * Get diayhorapiso
     *
     * @return \DateTime
     */
    public function getDiayhorapiso()
    {
        return $this->diayhorapiso;
    }

    /**
     * Set diayhoratecho
     *
     * @param \DateTime $diayhoratecho
     *
     * @return Turno
     */
    public function setDiayhoratecho($diayhoratecho)
    {
        $this->diayhoratecho = $diayhoratecho;

        return $this;
    }

    /**
     * Get diayhoratecho
     *
     * @return \DateTime
     */
    public function getDiayhoratecho()
    {
        return $this->diayhoratecho;
    }

}

