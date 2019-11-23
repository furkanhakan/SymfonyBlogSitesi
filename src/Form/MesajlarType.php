<?php

namespace App\Form;

use App\Entity\Mesajlar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MesajlarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adi')
            ->add('mailadresi')
            ->add('konu')
            ->add('mesaj')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mesajlar::class,
            'csrf_protection'=>false,
        ]);
    }
}
