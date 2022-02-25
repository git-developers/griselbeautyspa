<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // []
        $builder
            ->add('email',
                EmailType::class,
                [
                    'attr' => ['placeholder' => 'Your email address'],
                    'constraints' => [
                        new NotBlank(["message" => "Please provide a valid email"]),
                        new Email(["message" => "Your email doesn't seems to be valid"]),
                    ]
                ]
            )
            ->add('name')
            ->add('lastName')
            ->add('phone')
            ->add('address')
            ->add('notes')
            /*->add('roles')*/
            ->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
