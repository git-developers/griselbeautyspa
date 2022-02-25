<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ProductCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('isActive')
            ->add('productCategory', EntityType::class, [
                'label' => 'Category',
                'class' => ProductCategory::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ])
/*            ->add('price', NumberType::class, array(
                'label' => false,
                'required' => true,
                'error_bubbling' => true,
                'attr' => array(
                    'placeholder' => 'Mobile Phone',
                    'pattern'     => '.{2,}', //minlength
                    'class' => 'form-field-set'
                )))*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
