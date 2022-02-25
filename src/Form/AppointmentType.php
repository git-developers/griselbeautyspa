<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Profile;
use App\Entity\Xservice;
use App\Entity\Appointment;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('xDate', DateType::class, [
                'label' => 'Date',
                'attr' => [
                    'class' => 'form-control'
                ],
                'widget' => 'single_text',
            ])
            ->add('note', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
            ])
            ->add('staffMember', EntityType::class, [
                'class' => User::class,
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('main')
                        ->select('u')
                        ->from('App\Entity\User', 'u')
                        ->innerJoin('main.profile', 'p')
                        ->where('u.profile = p.id AND p.code = :profile')
                        ->setParameter(':profile', Profile::STAFF_MEMBER)
                        ->orderBy('u.id', 'DESC')
                        ;

                },
                'choice_label' => function($name){
                    return $name->getFullName();
                },
                'mapped' => true,
                'multiple' => false,
            ])
            ->add('customers', EntityType::class, [
                'class' => User::class,
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('main')
                        ->select('u')
                        ->from('App\Entity\User', 'u')
                        ->innerJoin('main.profile', 'p')
                        ->where('u.profile = p.id AND p.code = :profile')
                        ->setParameter(':profile', Profile::CUSTOMER)
                        ->orderBy('u.id', 'DESC')
                        ;

                },
                'choice_label' => function($name){
                    return $name->getFullName();
                },
                'mapped' => true,
                'multiple' => true,
            ])
            ->add('xService', EntityType::class, [
                'label' => 'Service',
                'class' => Xservice::class,
                'choice_label' => function ($o) {
                    return $o->getName();
                }
            ])
            ->add('periodStart', ChoiceType::class, [
                'choices'  => [
                    '6:00 am' => '6:00 am',
                    '7:00 am' => '7:00 am',
                    '8:00 am' => '8:00 am',
                    '9:00 am' => '9:00 am',
                    '10:00 am' => '10:00 am',
                ],
            ])
            ->add('periodEnd', ChoiceType::class, [
                'choices'  => [
                    '6:00 am' => '6:00 am',
                    '7:00 am' => '7:00 am',
                    '8:00 am' => '8:00 am',
                    '9:00 am' => '9:00 am',
                    '10:00 am' => '10:00 am',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
