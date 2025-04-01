<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'Gestionnaire' => 'ROLE_GESTIONNAIRE',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Sélectionné le rôle de l\'utilisateur',
                'attr' => ['class' => 'form-control form-control-sm select2'],
                'mapped' => false,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'label_attr' => ['class' => 'col-form-label'],
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => 6]),
                    ],
                    'attr' => ['class' => 'form-control form-control-sm'],
                ],
                'second_options' => [
                    'label' => 'Confirmer mot de passe',
                    'label_attr' => ['class' => 'col-md-2 col-form-label'],
                    'attr' => ['class' => 'form-control form-control-sm'],
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
