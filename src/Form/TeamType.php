<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Dance;
use App\Entity\Dancer;
use App\Entity\Team;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$club = $options['club'];

		$builder->add('dances', EntityType::class, array('label' => 'Liste des danses', 'attr' => ['class' => 'form-check'], // query choices from this entity
				'class' => Dance::class,

				// use the User.username property as the visible option string
				'choice_label' => 'nameDance',

				// used to render a select box, check boxes or radios
				// 'multiple' => true,
				// 'expanded' => true,
				'required' => true, 'expanded' => true, 'multiple' => true, 'by_reference' => false))//            ->add('dances')
			->add('dancers',
			EntityType::class, [
				'label' => 'Liste des danseurs',
				'class' => Dancer::class,
				'query_builder' => function(EntityRepository $er) use ($club) {
					return $er
						->createQueryBuilder('d')
						->andWhere('d.isAuthorized = 1')
						->andWhere('d.club = :club')
						->setParameter('club',$club);
				},
				'choice_label' => function(Dancer $dancer) {
					return strval($dancer->getNameDancer() . " " . $dancer->getFirstNameDancer() . " | " . $dancer->getDateBirthDancer()->format('d-m-Y'));
				},
				'expanded' => true, 'multiple' => true, 'by_reference' => false])
            //->add('category', EntityType::class, array(
            //    'label'=>"Catégorie",
            //    'class' => Category::class,
            //    'choice_label' => 'nameCategory',
            //    'required' => false,
            //    'expanded'=>true,
            //    'multiple'=>false
            //))
				->add('save', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-outline-success']]);
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(['data_class' => Team::class,]);
		$resolver->setRequired(array('club',));
	}
}