<?php

namespace App\Form;

use App\Entity\Dancer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DancerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameDancer', TextType::class, array('label' => 'Nom'))
            ->add('firstNameDancer', TextType::class, array('label' => 'Prénom'))
            ->add('dateBirthDancer', DateTimeType::class,[
                'label'=>"Date de naissance",
	            'widget'=>'single_text',
	            'format' => 'd-M-y',
	            'html5' => false,
	            'attr' => ['class' => 'js-datepicker']
            ])
            ->add('emailDancer', TextType::class, array('label' => 'Adresse e-mail'))
	        ->add('save', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['class' => 'btn btn-outline-success'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dancer::class,
        ]);
    }
}
