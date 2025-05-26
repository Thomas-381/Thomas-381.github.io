<?php

namespace App\Form;

use App\Entity\Ide;
use App\Entity\Langage;
use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LangageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('version')
            ->add('projets', EntityType::class, [
                'required' => false,
                'class' => Projet::class,
                'choice_label' => 'nom',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('ides', EntityType::class, [
                'required' => false,
                'class' => Ide::class,
                'choice_label' => 'nom',
                'expanded' => true,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Langage::class,
        ]);
    }
}
