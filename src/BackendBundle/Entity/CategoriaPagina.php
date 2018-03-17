<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Categoria
 *
 * @ORM\Table(name="categoriaPagina")
 * @ORM\Entity
 */
class CategoriaPagina
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
    // ...
    /**
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="\BackendBundle\Entity\CategoriaPagina", mappedBy="categoriaPadre", cascade={"persist", "remove"})
     */
    private $subCategorias;

     /**
     *Many Categories have One Category.
     *@ORM\ManyToOne(targetEntity="\BackendBundle\Entity\CategoriaPagina", inversedBy="subCategorias", cascade={"persist", "remove"})
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
     * @return CategoriaPagina
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
     * Set categoriaPadre
     *
     * @param string $categoriaPadre
     *
     * @return CategoriaPagina
     */
    public function setCategoriaPadre(\BackendBundle\Entity\CategoriaPagina $categoriaPadre)
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
     * @param \BackendBundle\Entity\CategoriaPadre $subCategoria
     *
     * @return CategoriaPagina
     */
    public function addSubCategoria(\BackendBundle\Entity\CategoriaPagina $subCategoria)
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
    public function removeSubCategoria(\BackendBundle\Entity\CategoriaPagina $subCategoria)
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

