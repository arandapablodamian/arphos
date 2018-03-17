<?php

namespace BackendBundle\Controller;

use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    // FOSUSER
    public function createNewUserEntity()
    {   
        // dump('creo usuario');
        // die;
        return $this->get('fos_user.user_manager')->createUser();
    }
    public function persistUserEntity($user)
    {
        
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }
    public function updateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }
    // CREATED UPDATED
    public function updateEntity($entity)
    {
        if (method_exists($entity, 'setFechaModificacion')) {
            $entity->setFechaModificacion(new \DateTime());
        }

        parent::updateEntity($entity);
    }
    public function persistEntity($entity)
    {
        if (method_exists($entity, 'setFechaCreacion')) {
            $entity->setFechaCreacion(new \DateTime());
        }

        parent::persistEntity($entity);
    }
}