<?php

namespace App\Form;

use App\Entity\Langage;
use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('description', TextAreaType::class, [
                'label' => 'Courte description pour la page d\'accueil',
                'attr' => [
                    'placeholder' => 'Ce projet est...',
                    'rows' => 3,
                ],
            ])
            ->add('descriptionLongue', TextAreaType::class, [
                'label' => 'Longue description pour la page projet',
                'attr' => [
                    'placeholder' => 'Ce projet est...',
                    'rows' => 7,
                ],
            ])
            ->add('duree', TextType::class)
            ->add('equipe', TextType::class)
            ->add('visuel', TextType::class)
            ->add('lienGithub', UrlType::class, [
                'required' => false,
            ])
            ->add('important', CheckboxType::class, [
                'required' => false,
                'label' => 'Mettre en avant ce projet sur la page d\'accueil',
            ])
            ->add('langage', EntityType::class, [
                'required' => false,
                'class' => Langage::class,
                'choice_label' => 'nom',
                'expanded' => true,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
