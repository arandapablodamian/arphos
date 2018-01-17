<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('precio')
            ->add('color')
            ->add('fechaCreacion', \SC\DatetimepickerBundle\Form\Type\DatetimeType::class, [
                'pickerOptions' => [
                    'format'    => 'mm/dd/yyyy hh:ii',
                    'startView' => 'month',
                    'minView'   => 'hour',
                    'maxView'   => 'decade',
                    'todayBtn'  => true,
                ]
            ])
            ->add('fechaModificacion', \SC\DatetimepickerBundle\Form\Type\DatetimeType::class, [
                'pickerOptions' => [
                    'format'    => 'mm/dd/yyyy hh:ii',
                    'startView' => 'month',
                    'minView'   => 'hour',
                    'maxView'   => 'decade',
                    'todayBtn'  => true,
                ]
            ])
            ->add('stock')
            ->add('esNovedad')
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
