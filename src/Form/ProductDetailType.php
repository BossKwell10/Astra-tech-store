<?php

namespace App\Form;

use App\Entity\Admin\ProductDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etat', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('marque', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('modele', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('processeur', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('ram', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('stockage', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('carteGraphique', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('osInstalle', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('tailleEcran', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('resolution', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('claviers', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('webcam', ChoiceType::class, [
                'attr' => ['class' => 'form-control form-control-sm select2'],
                'required' => false,
                'choices'  => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ],
            ])
            ->add('connexionWifi', ChoiceType::class, [
                'attr' => ['class' => 'form-control form-control-sm select2'],
                'required' => false,
                'choices'  => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ],
            ])
            ->add('lecteurOption', ChoiceType::class, [
                'attr' => ['class' => 'form-control form-control-sm select2'],
                'required' => false,
                'choices'  => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ],
            ])
            ->add('ports', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('dimension', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('poids', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
            ->add('fournisAvec', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductDetail::class,
        ]);
    }
}
