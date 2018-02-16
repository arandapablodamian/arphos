<?php

namespace BackendBundle\Form;

use BackendBundle\Entity\Resource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use MWSimple\Bundle\AdminCrudBundle\Form\Type\ButtonDeleteType;

class ResourceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('epigrafe', null, [
                'label' => 'Epígrafe',
                'attr' => [
                    'col' => 'col-md-4',
                ],
            ])
            ->add('imageFile', VichImageType::class, array(
                'label'         => 'Imágen (jpeg/png)',
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
                'attr' => [
                    'col' => 'col-md-4',
                ],
            ))
            ->add('ButtonDelete', ButtonDeleteType::class, [
                'mapped' => false,
                'attr' => [
                    'col' => 'col-md-1 col-md-push-3',
                ],
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Resource::class,
        ));
    }
}
