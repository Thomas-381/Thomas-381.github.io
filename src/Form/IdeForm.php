<?php

namespace App\Form;

use App\Entity\Ide;
use App\Entity\Langage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                    'required' => true
                ]
            )
            ->add('visuel', TextType::class, [
                    'required' => true
                ]
            )
            ->add('couleur', ColorType::class, [
                'required' => false,
                'empty_data' => '#000000',
            ])
            ->add('Langage', EntityType::class, [
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
            'data_class' => Ide::class,
        ]);
    }
}
