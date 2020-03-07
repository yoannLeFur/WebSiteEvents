<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Creations;
use App\Entity\Events;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('descriptions')
                ->add('events', EntityType::class, [
                    'class' => Events::class,
                    'required' => false,
                    'choice_label' => 'name',
                    'attr' => ['data-select' => 'false', 'data-placeholder' => 'Choisir un evènement']
                ])
                ->add('user', EntityType::class, [
                    'class' => Users::class,
                    'required' => false,
                    'choice_label' => 'fullname',
                    'attr' => ['data-select' => 'false', 'data-placeholder' => 'Associer un client à cette création']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Creations::class,
            'translation_domain' => 'forms'
        ));
    }

}