<?php

namespace BackendBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @var string
     * @ORM\Column(name="telefono", type="string")
     */
    private $telefono;

    /**
     * @var \String
     *
     * @ORM\Column(name="dia", type="date")
     */
    private $dia;

    /**
     * @var \Time
     *
     * @ORM\Column(name="horatecho", type="time", nullable= true)
     */
    private $horatecho;

    /**
     * @var \Time
     *
     * @ORM\Column(name="hora", type="time")
     */
    private $hora;


    /**
     * @ORM\ManyToOne(targetEntity="\BackendBundle\Entity\Cliente")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    private $cliente;

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
     * @param string $telefono
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
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set dia
     *
     * @param \Date $dia
     *
     * @return Turno
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return \Date
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set horatecho
     *
     * @param \Time $horatecho
     *
     * @return Turno
     */
    public function setHoratecho($horatecho)
    {
        $this->horatecho = $horatecho;

        return $this;
    }

    /**
     * Get horatecho
     *
     * @return \Time
     */
    public function getHoratecho()
    {
        return $this->horatecho;
    }

        /**
     * Set hora
     *
     * @param \Time $hora
     *
     * @return Turno
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \Time
     */
    public function getHora()
    {
        return $this->hora;
    }

    
     /**
     * Set cliente
     *
     * @param  $cliente
     *
     * @return \BackendBundle\Entity\Cliente
     */
    public function setCliente(\BackendBundle\Entity\Cliente $cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \BackendBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

}

