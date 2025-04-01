<?php

namespace App\Form;

use App\Entity\Admin\Category;
use App\Entity\Admin\Domaine;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('domaine', EntityType::class, [
                'class' => Domaine::class,
                'attr' => ['class' => 'form-control form-control-sm select2'],
                'placeholder' => 'Sélectionner le domaine',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
