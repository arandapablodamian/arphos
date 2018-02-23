<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Tecspro\Bundle\ComunBundle\Services\Slugify;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_role")
 */
class Role implements RoleInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;


    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->getName();
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Role
     */
    public function setName($name)
    {
        $slugify = new Slugify();
        $this->name = $slugify->slugify($name);
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return 'ROLE_'.$this->name;
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        /*
         * ! Don't serialize $users field !
         */

        return \serialize(array(
            $this->id,
            $this->name,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->name
        ) = \unserialize($serialized);
    }
}
