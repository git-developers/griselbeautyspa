<?php

namespace App\Form;

use App\Entity\Xservice;
use App\Entity\XserviceCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class XserviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('isActive')
            ->add('xServiceCategory', EntityType::class, [
                'label' => 'Category',
                'class' => XserviceCategory::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Xservice::class,
        ]);
    }
}
