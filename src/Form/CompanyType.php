<?php

namespace App\Form;

use App\Entity\Campagny;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('sector', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('description', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('address', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm']
            ])
            ->add('postal', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('services', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('facebook', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm', 'placeholder' => 'Nom du compte facebook'],
            ])
            ->add('ticktok', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm', 'placeholder' => 'Nom du compte ticktok'],
            ])
            ->add('whathsapp', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm', 'placeholder' => 'Numero de téléphone whathsapp'],
            ])
            ->add('contact', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campagny::class,
        ]);
    }
}
