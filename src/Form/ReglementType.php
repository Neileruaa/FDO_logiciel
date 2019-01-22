<?php

namespace App\Form;

use App\Entity\Reglement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ReglementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('pdfFile', FileType::class, array(
                'label'=>'Choisir un règlement (fichier pdf uniquement)',
	            'attr' => array('accept'=>'.pdf', 'id' =>'customFile')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reglement::class,
        ]);
    }
}
