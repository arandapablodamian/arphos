<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcion')
            // ->add('subCategorias', \Tetranz\Select2EntityBundle\Form\Type\Select2EntityType::class, [
            //     'multiple' => true,
            //     'remote_route' => 'categoria_autocomplete_subcategorias',
            //     'class' => 'BackendBundle\Entity\Categoria',
            //     'minimum_input_length' => 0,
            //     'attr' => [
            //         'class' => "col-lg-12 col-md-12 col-sm-12",
            //         'col'   => "col-lg-12 col-md-12",
            //     ]
            // ])
            ->add('categoriaPadre', \Tetranz\Select2EntityBundle\Form\Type\Select2EntityType::class, [
                'multiple' => false,
                'remote_route' => 'categoria_autocomplete_categoriapadre',
                'class' => 'BackendBundle\Entity\Categoria',
                'minimum_input_length' => 0,
                'attr' => [
                    'class' => "col-lg-12 col-md-12 col-sm-12",
                    'col'   => "col-lg-12 col-md-12",
                ]
            ])
            
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'BackendBundle\Entity\Categoria'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_categoria';
    }


}
