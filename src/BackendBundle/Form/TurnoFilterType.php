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
 * TurnoFilterType filtro.
 * @author Nombre Apellido <name@gmail.com>
 */
class TurnoFilterType extends AbstractType
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
            ->add('apellido', Filters\TextFilterType::class, [
                'condition_pattern' => FilterOperands::OPERAND_SELECTOR,
            ])
            ->add('direccion', Filters\TextFilterType::class, [
                'condition_pattern' => FilterOperands::OPERAND_SELECTOR,
            ])
            ->add('telefono', Filters\NumberRangeFilterType::class)
            ->add('diayhora', Filters\DateTimeRangeFilterType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'BackendBundle\Entity\Turno',
            'csrf_protection'   => false,
            'validation_groups' => ['filtering'] // avoid NotBlank() constraint-related message
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_turnofiltertype';
    }


}
