<?php

namespace BackendBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="fos_user_role")
     */
    protected $userRoles;


    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->userRoles = new ArrayCollection();
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

    /**
     * Returns an ARRAY of Role objects with the default Role object appended.
     *
     * @return array
     */
    public function getRoles()
    {
        $roles = $this->userRoles->toArray();
        array_push($roles, 'ROLE_USER');

        return $roles;
    }

    /**
     * Returns the true ArrayCollection of Roles.
     *
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getRolesCollection()
    {
        return $this->userRoles;
    }

    /**
     * Pass a string, get the desired Role object or null.
     *
     * @param string $role
     *
     * @return Role|null
     */
    public function getRole($role)
    {
        foreach ($this->getRoles() as $roleItem) {
            if ($role == $roleItem) {
                return $roleItem;
            }
        }

        return;
    }

    /**
     * Pass a string, checks if we have that Role. Same functionality as getRole() except returns a real boolean.
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if ($this->getRole($role)) {
            return true;
        }

        return false;
    }

    /**
     * Adds a Role OBJECT to the ArrayCollection. Can't type hint due to interface so throws Exception.
     *
     * @throws Exception
     *
     * @param Role $role
     */
    public function addRole($role)
    {
        if (!$role instanceof Role) {
            throw new \Exception('addRole takes a Role object as the parameter');
        }

        if (!$this->hasRole($role->getRole())) {
            $this->userRoles->add($role);
        }
    }

    /**
     * Pass a string, remove the Role object from collection.
     *
     * @param string $role
     */
    public function removeRole($role)
    {
        $roleElement = $this->getRole($role);
        if ($roleElement) {
            $this->userRoles->removeElement($roleElement);
        }
    }

    /**
     * Pass an ARRAY of Role objects and will clear the collection and re-set it with new Roles.
     * Type hinted array due to interface.
     *
     * @param array $userRoles Of Role objects.
     */
    public function setRoles(array $userRoles)
    {
        $this->userRoles->clear();
        foreach ($userRoles as $role) {
            $this->addRole($role);
        }
    }

    /**
     * Directly set the ArrayCollection of Roles. Type hinted as Collection which is the parent of (Array|Persistent)Collection.
     *
     * @param Doctrine\Common\Collections\Collection $role
     */
    public function setRolesCollection(Collection $collection)
    {
        $this->userRoles = $collection;
    }

    /**
     * Add userRoles.
     *
     * @param \Sistema\UserBundle\Entity\Role $userRoles
     *
     * @return User
     */
    public function addUserRole(\BackendBundle\Entity\Role $userRoles)
    {
        $this->userRoles[] = $userRoles;

        return $this;
    }

    /**
     * Remove userRoles.
     *
     * @param \Sistema\UserBundle\Entity\Role $userRoles
     */
    public function removeUserRole(\BackendBundle\Entity\Role $userRoles)
    {
        $this->userRoles->removeElement($userRoles);
    }

    /**
     * Get userRoles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }
}
