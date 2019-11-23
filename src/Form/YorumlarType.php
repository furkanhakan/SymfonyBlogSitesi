<?php

namespace App\Form;

use App\Entity\Yorumlar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class YorumlarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('yorumid')
            ->add('parentid')
            ->add('yorum')
            ->add('yorumtarihi')
            ->add('yorumadi')
            ->add('yorummail')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Yorumlar::class,
            'csrf_protection'=>false,
        ]);
    }
}
