<?php

namespace App\Form;

use App\Entity\Background;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BackgroundType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
                ->add('description')
                ->add('logo', FileType::class, [
                    'required' => false
                ])
                ->add('screen', FileType::class, [
                'required' => false
    ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Background::class,
            'translation_domain' => 'forms'
        ));
    }

}