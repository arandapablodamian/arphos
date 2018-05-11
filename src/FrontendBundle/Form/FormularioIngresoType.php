<?php

namespace FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

use BackendBundle\Entity\Cliente;

class FormularioContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',null,array('label'=>'Nombre'))
            ->add('apellido',null,array('label'=>'Apellido'))
            ->add('direccion',null,array( 'label' => 'Dirección'))
             ->add('telefono',null,array('label' => 'Teléfono'))
            ->add('email',EmailType::class, [
                'label' => 'Email'
            ])
             ->add('mensaje',TextareaType::class, [
                'label' => 'mensaje'
            ])
            ->add('enviar', SubmitType::class, array(
                'label' => 'Enviar','attr'=>['class'=>'btn-success'],
            ))
            //  ->add('limpiar', ResetType::class, array(
            //     'label' => 'Limpiar'
            // )
            //  );
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Cliente::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontendbundle_cliente';
    }


}
