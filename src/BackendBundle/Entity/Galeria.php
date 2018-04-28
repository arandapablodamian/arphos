<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Noticia
 *
 * @ORM\Table(name="galeria")
 * @ORM\Entity
 */


class Galeria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
   
    /**
     * @var boolean
     *
     * @ORM\Column(name="publicado", type="boolean", nullable=true)
     */
    private $publicado;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $post;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    private $orden;

    

    public function __toString() {
        return $this->getTitulo();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    

    /**
     * Set publicado
     *
     * @param boolean $publicado
     *
     * @return Noticia
     */
    public function setPublicado($publicado)
    {
        $this->publicado = $publicado;

        return $this;
    }

    /**
     * Get publicado
     *
     * @return boolean
     */
    public function getPublicado()
    {
        return $this->publicado;
    }

   
    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Noticia
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
     * Get post
     *
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set post
     *
     * @param string $post
     *
     * @return Galeria
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

        /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return integer
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }
   


}
