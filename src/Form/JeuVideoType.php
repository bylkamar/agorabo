<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\JeuVideo;
use App\Entity\Marque;
use App\Entity\Pegi;
use App\Entity\Plateforme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class JeuVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('refJeu', TextType::class, [
                'label' => 'REF'
            ])
            ->add('nom', TextType::class, [
                'label' => 'Libellé'
            ])
            ->add(
                'prix',
                MoneyType::class,
                [
                    'label' => 'Prix',
                    'invalid_message' => 'Nombre attendu'
                ]
            )
            ->add('dateParution', DateType::class, [
                'label' => 'Date de parution',
                'widget' => 'single_text',
            ])
            ->add('genre', EntityType::class, [
                'label' => 'Genre',
                'class' => Genre::class,
                'choice_label' => 'libelle',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('pegi', EntityType::class, [
                'label' => 'PEGI',
                'class' => Pegi::class,
                'choice_label' => 'ageLimite',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('marque', EntityType::class, [
                'label' => 'Marque',
                'class' => Marque::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('plateforme', EntityType::class, [
                'label' => 'Plateforme',
                'class' => Plateforme::class,
                'choice_label' => 'libelle',
                'multiple' => false,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JeuVideo::class,
        ]);
    }
}
