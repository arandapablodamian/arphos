<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\CategoriaRepository")
 */
class Categoria
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    // ...
    /**
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="\BackendBundle\Entity\Categoria", mappedBy="categoriaPadre", cascade={"persist", "remove"})
     */
    private $subCategorias;

     /**
     *Many Categories have One Category.
     *@ORM\ManyToOne(targetEntity="\BackendBundle\Entity\Categoria", inversedBy="subCategorias", cascade={"persist", "remove"})
     *@ORM\JoinColumn(name="categoria_padre", referencedColumnName="id")
     */
    private $categoriaPadre;
    
     

   



    public function __construct() {
        $this->subCategorias = new \Doctrine\Common\Collections\ArrayCollection();
    
    }

      public function __toString() {
        return $this->getTitulo();
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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Categoria
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Categoria
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

     /**
     * Set categoriaPadre
     *
     * @param string $categoriaPadre
     *
     * @return Categoria
     */
    public function setCategoriaPadre(\BackendBundle\Entity\Categoria $categoriaPadre)
    {
        $this->categoriaPadre = $categoriaPadre;

        return $this;
    }

    /**
     * Get categoriaPadre
     *
     * @return string
     */
    public function getCategoriaPadre()
    {
        return $this->categoriaPadre;
    }

    /**
     * Add subCategoria
     *
     * @param \BackendBundle\Entity\Categoria $subCategoria
     *
     * @return Categoria
     */
    public function addSubCategoria(\BackendBundle\Entity\Categoria $subCategoria)
    {
        $subCategoria->setCategoriaPadre($this);
        $this->subCategorias[] = $subCategoria;

        return $this;
    }

    /**
     * Remove subCategoria
     *
     * @param \BackendBundle\Entity\Categoria $subCategoria
     */
    public function removeSubCategoria(\BackendBundle\Entity\Categoria $subCategoria)
    {
        $this->subCategorias->removeElement($subCategoria);
    }

    /**
     * Get subCategorias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubCategorias()
    {
        return $this->subCategorias;
    }

}

