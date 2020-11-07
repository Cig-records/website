<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, ['label' => 'Pseudo'])
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('lastname', TextType::class, ['label' => 'Nom'])
            ->add('birthdate', TextType::class, ['label' => 'Date d\'anniversaire'])
            ->add('email', EmailType::class, ['label' => 'Adresse mail'])
            ->add('password',RepeatedType::class, [
                        'type' => PasswordType::class,
                        'invalid_message' => 'The password fields must match.',
                        'options' => ['attr' => ['class' => 'password-field']],
                        'required' => true,
                        'first_options'  => ['label' => 'Mot de passe'],
                        'second_options' => ['label' => 'Confirmation du mot de passe'],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
