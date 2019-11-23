<?php

namespace App\Form;

use App\Entity\Gonderi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GonderiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gonderibasligi')
            ->add('gonderiicerigi')
            ->add('kapak')
            ->add('kategori')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gonderi::class,
            'csrf_protection'=>false,
        ]);
    }
}
