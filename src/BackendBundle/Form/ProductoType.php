<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MWSimple\Bundle\AdminCrudBundle\Form\Type\EmbedType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use MWSimple\Bundle\AdminCrudBundle\Form\Type\ButtonDeleteType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
class ProductoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, array(
                'label'=>'Nombre',
                'attr'=>[
                    'col'=>'col-md-5'
                ]))

            ->add('esNovedad',null,array(
                'label'=>'Novedad',
                'attr'=>[
                    'col'=>'col-md-3'
                ]))

            ->add('descripcion', CKEditorType::class, array(
                 'attr'=>[
                    'col'=>'col-md-12'
                ],
                'config' => array(
                'uiColor' => '#ffffff',
                )))

            ->add('precio',null,array(
                'label'=>'Precio',
                'attr'=>[
                    'col'=>'col-md-3'
                ]))
            ->add('stock',null,array(
                'label'=>'Stock',
                'attr'=>[
                    'col'=>'col-md-3'
                ]))
            
            ->add('imageFile', VichImageType::class, array(
                'label'         => 'Imágen (jpeg/png)',
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
                'attr' => [
                    'col' => 'col-md-4',
                ],
            ))
            ->add('categorias', \Tetranz\Select2EntityBundle\Form\Type\Select2EntityType::class, [
                'multiple' => true,
                'remote_route' => 'producto_autocomplete_categorias',
                'class' => 'BackendBundle\Entity\Categoria',
                'minimum_input_length' => 0,
                'attr' => [
                    'class' => "col-lg-12 col-md-12 col-sm-12",
                    'col'   => "col-lg-12 col-md-12",
                ]
            ])


            ->add('color',ColorType::class, array(
                'label'=>'Eliga un color',
                'attr'=>[
                    'col'=>'col-md-3'
                ]))

            ->add('fechaCreacion', \SC\DatetimepickerBundle\Form\Type\DatetimeType::class, [
                'pickerOptions' => [
                    'format'    => 'dd/mm/yyyy hh:ii',
                    'startView' => 'month',
                    'minView'   => 'month',
                    'maxView'   => 'decade',
                    'todayBtn'  => true,
                    'language' => 'es',
                ]
            ])
            ->add('fechaModificacion', \SC\DatetimepickerBundle\Form\Type\DatetimeType::class, [
                'pickerOptions' => [
                    'format'    => 'dd/mm/yyyy hh:ii',
                    'startView' => 'month',
                    'minView'   => 'month',
                    'maxView'   => 'decade',
                    'todayBtn'  => true,
                    'language' => 'es',
                ]
            ])
            

            ->add('resources', EmbedType::class, [
                'entry_type' => ResourceType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'attr' => [
                    'class' => 'resource_embed',
                    'col' => 'col-md-12',
                    'embed' => 'row',
                    'embed_row_col' => 'col-md-12',
                    'embed_row_style' => 'border-bottom: thin solid; margin: 10px 0px;',
                ],
            ])
           
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'BackendBundle\Entity\Producto'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_producto';
    }


}
