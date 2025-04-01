<?php

namespace App\Form;

use App\Entity\Admin\Category;
use App\Entity\Admin\Type;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeFomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('categorie', EntityType::class, [
                'class' => Category::class,
                'attr' => ['class' => 'form-control form-control-sm select2'],
                'placeholder' => 'Sélectionner la categorie',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Type::class,
        ]);
    }
}
