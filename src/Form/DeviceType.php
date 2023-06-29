<?php

namespace App\Form;

use App\Entity\Device;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('image')
            ->add('stock')
            ->add('memory',null, ['choice_label' => 'numberMemory'])
            ->add('storage',null, ['choice_label' => 'numberStorage'])
            ->add('sizeScreen',null, ['choice_label' => 'numberSizeScreen'])
            ->add('camera',null, ['choice_label' => 'numberPixel '])
            ->add('state' ,null, ['choice_label' => 'nameState'])
            ->add('brand',null, ['choice_label' => 'nameBrand'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Device::class,
        ]);
    }
}
