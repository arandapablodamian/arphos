<?php

namespace FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoComprado
 *
 * @ORM\Table(name="producto_comprado")
 * @ORM\Entity(repositoryClass="FrontendBundle\Repository\ProductoCompradoRepository")
 */
class ProductoComprado
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
     * @ORM\Column(name="session", type="string", length=255)
     */
    private $session;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="string", length=255)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="string", length=255)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="talle", type="string", length=255)
     */
    private $talle;


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
     * Set session
     *
     * @param string $session
     *
     * @return ProductoComprado
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ProductoComprado
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
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return ProductoComprado
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return ProductoComprado
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set talle
     *
     * @param string $talle
     *
     * @return ProductoComprado
     */
    public function setTalle($talle)
    {
        $this->talle = $talle;

        return $this;
    }

    /**
     * Get talle
     *
     * @return string
     */
    public function getTalle()
    {
        return $this->talle;
    }

    public function __toString() {
        return $this->getNombre() . " " . $this->getTalle() . " " . $this->getCantidad();
    }
}

