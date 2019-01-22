<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Competition;
use App\Entity\Dance;
use App\Entity\Judge;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label'=>"Nom de la compétition"
            ))
            ->add('dateCompetition', DateType::class, array(
                'label'=>'Date de la compétition',
                'widget'=>'single_text',
                'format' => 'd-M-y',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker']
            ))
            ->add('city', TextType::class, array(
                'label'=>"Ville"
            ))
            ->add('address', TextType::class, array(
                'label'=>'Adresse'
            ))
            ->add('postalCode', NumberType::class, array(
                'label'=>'Code postal'
            ))
            ->add('dances', EntityType::class, [
                'label'=>'Liste des danses',
                'class'=> Dance::class,
                'choice_label'=>'nameDance',
                'required'=>true,
                'expanded'=>false,
                'multiple'=>true,
                'by_reference'=>false
            ])
            ->add('judges', EntityType::class, [
                'label'=>'Liste des juges',
                'class'=> Judge::class,
                'choice_label'=>'nameJudge',
                'required'=>false,
                'expanded'=>false,
                'multiple'=>true,
                'by_reference'=>false
            ])
            ->add('clubOrganizer', EntityType::class, [
                'label'=>'Club organisateur',
                'class'=> Club::class,
                'choice_label'=>'username',
                'required'=>true,
                'expanded'=>false,
                'multiple'=>false
            ])
            ->add('nbMaxTeam', NumberType::class, array(
                'label'=>'Nombre d\'équipes maximum'
            ))
            ->add('description', TextareaType::class, array(
                'label'=>"Description de la compétition"
            ))
            ->add('save', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['class' => 'btn btn-outline-success'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
