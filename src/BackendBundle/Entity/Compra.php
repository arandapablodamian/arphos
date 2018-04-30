<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Compra
 *
 * @ORM\Table(name="compra")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\CompraRepository")
 */
class Compra
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
     * @ORM\ManyToOne(targetEntity="\BackendBundle\Entity\Producto")
     * @ORM\JoinColumn(name="usesr_id", referencedColumnName="id")
     */
    private $usuario;

      /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCompra", type="datetime")
     */
    private $fechaCompra;

     /**
     * @var string
     *
     * @ORM\Column(name="montoTotal", type="float") }
     */
    private $montoTotal;

   /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="\FrontendBundle\Entity\ProductoComprado")
     * @ORM\JoinTable(name="compra_producto",
     *      joinColumns={@ORM\JoinColumn(name="compra_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="producto_id", referencedColumnName="id")}
     *      )
     */
    private $productos;


    public function __construct() {
        $this->productos = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set montoTotal
     *
     * @param float $double
     *
     * @return Compra
     */
    public function setMontoTotal($montoTotal)
    {
        $this->montoTotal = $montoTotal;

        return $this;
    }

    /**
     * Get montoTotal
     *
     * @return montoTotal
     */
    public function getMontoTotal()
    {
        return $this->montoTotal;
    }

   


    /**
     * Set fechaCompra
     *
     * @param \DateTime $fechaCompra
     *
     * @return Compra
     */
    public function setFechaCompra($fechaCompra)
    {
        $this->fechaCompra = $fechaCompra;

        return $this;
    }

    /**
     * Get fechaCompra
     *
     * @return \DateTime
     */
    public function getFechaCompra()
    {
        return $this->fechaCompra;
    }


       /**
     * Add producto
     *
     * @param \BackendBundle\Entity\Producto $producto
     *
     * @return Compra
     */
    public function addProducto(\FrontendBundle\Entity\ProductoComprado $producto)
    {
        $this->productos[] = $producto;

        return $this;
    }

    /**
     * Remove producto
     *
     * @param \BackendBundle\Entity\Producto $producto
     */
    public function removeProducto(\FrontendBundle\Entity\ProductoComprado $producto)
    {
        $this->productos->removeElement($producto);
    }

    /**
     * Get productos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductos()
    {
        return $this->productos;
    }
    

      /**
     * Add usuario
     *
     * @param \BackendBundle\Entity\user $user
     *
     * @return Compra
     */
    public function setUsuario(\BackendBundle\Entity\User $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
    /**
     * Get usuario
     *
     * @return usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    

}

