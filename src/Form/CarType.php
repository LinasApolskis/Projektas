<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class)
            ->add('model', TextType::class)
            ->add('licence', TextType::class)
            ->add('year', IntegerType::class)
            ->add('body', TextType::class)
            ->add('fuel', ChoiceType::class, array(
                'choices'  => array(
                    'Gasoline' => 'Gasoline',
                    'Diesel' => 'Diesel',
                    'Electricity' => 'Electricity',
                ),))
            ->add('engine', TextType::class)
            ->add('power', TextType::class)
            ->add('gearbox', ChoiceType::class, array(
                'choices'  => array(
                    'Manual' => 'Manual',
                    'Automatic' => 'Automatic',
                ),))
            ->add('mileage', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Car::class,
        ));
    }
}
