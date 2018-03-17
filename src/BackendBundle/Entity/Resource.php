<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Resource
 *
 * @ORM\Table(name="resource")})
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\ResourceRepository")
 * @Vich\Uploadable
 */
class Resource
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
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="epigrafe", type="text", nullable=true)
     */
    private $epigrafe;

    /**
     * @var \BackendBundle\Entity\Producto
     *
     * @ORM\ManyToOne(targetEntity="\BackendBundle\Entity\Producto", inversedBy="resources")
     * @ORM\JoinColumn(name="producto", referencedColumnName="id")
     */
    private $producto;

    /**
     * @var \BackendBundle\Entity\Pagina
     *
     * @ORM\ManyToOne(targetEntity="\BackendBundle\Entity\Pagina", inversedBy="resources")
     * @ORM\JoinColumn(name="pagina", referencedColumnName="id")
     */
    private $pagina;

   

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="resource_image", fileNameProperty="path")
     * 
     * @var File
     * @Assert\Image(
     *     maxSize = "20M",
     *     mimeTypes={"image/jpeg", "image/png"}
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     * @Assert\NotNull
     */
    private $updatedAt;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->updatedAt = new \DateTime('now');
         $this->resources = new ArrayCollection();
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
     * Set path
     *
     * @param string $path
     *
     * @return Resource
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set epigrafe
     *
     * @param string $epigrafe
     *
     * @return Resource
     */
    public function setEpigrafe($epigrafe)
    {
        $this->epigrafe = $epigrafe;

        return $this;
    }

    /**
     * Get epigrafe
     *
     * @return string
     */
    public function getEpigrafe()
    {
        return $this->epigrafe;
    }

    /**
     * Set pagina
     *
     * @param \BackendBundle\Entity\Producto $producto
     *
     * @return Resource
     */
    public function setProducto(\BackendBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get pagina
     *
     * @return \BackendBundle\Entity\Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

      /**
     * Set pagina
     *
     * @param \BackendBundle\Entity\Pagina $pagina
     *
     * @return Resource
     */
    public function setPagina(\BackendBundle\Entity\Pagina $pagina = null)
    {
        $this->pagina = $pagina;

        return $this;
    }

    /**
     * Get pagina
     *
     * @return \BackendBundle\Entity\Pagina
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    

    

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Resource
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
