<?php

namespace App\Form;

use App\Entity\CatTournois;
use App\Entity\Participant;
use App\Entity\Tournoi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('dateCreation', null, [
                'widget' => 'single_text',
            ])
            ->add('nb_participants')
            ->add('categorie', EntityType::class, [
                'class' => CatTournois::class,
                'choice_label' => 'libelle',
            ])
            ->add('participants', EntityType::class, [
                'class' => Participant::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournoi::class,
        ]);
    }
}
