<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

/**
 * TalleFilterType filtro.
 * @author Nombre Apellido <name@gmail.com>
 */
class TalleFilterType extends AbstractType
{
        /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', Filters\TextFilterType::class, [
                'condition_pattern' => FilterOperands::OPERAND_SELECTOR,
            ])
            ->add('cantidad', Filters\NumberRangeFilterType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'BackendBundle\Entity\Talle',
            'csrf_protection'   => false,
            'validation_groups' => ['filtering'] // avoid NotBlank() constraint-related message
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_tallefiltertype';
    }


}
