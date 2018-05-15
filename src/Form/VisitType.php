<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Visit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class VisitType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('car_id', EntityType::class, array(
                'class' => Car::class,
                'query_builder' => function (EntityRepository $er)use($options) {
                    return $er->createQueryBuilder('p')
                        ->andWhere('p.user = :userid')
                        ->setParameter('userid', $options['userid']);
                },
                'choice_label' => 'licence',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ))
            ->add('date', DateTimeType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Visit::class,
            'userid' => false,
        ));
    }
}
