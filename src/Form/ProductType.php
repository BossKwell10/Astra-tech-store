<?php

namespace App\Form;

use App\Entity\Admin\Product;
use App\Entity\Admin\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k', // Taille maximale de 1 Mo
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/pjpeg', // Ajout d'un type MIME alternatif
                            'image/png',
                            'image/avif',
                        ],
                        'mimeTypesMessage' => 'Fichier non valide! Veuillez télécharger une image au format JPEG, AVIF ou PNG .',
                    ]),
                ],
            ])
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('price', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm separator text-end'],
            ])
            ->add('stock', TextType::class, [
                'attr' => ['class' => 'form-control form-control-sm separator text-end'],
            ])
            ->add('detail', TextareaType::class, [
                'attr' => ['class' => 'form-control form-control-sm'],
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'placeholder' => 'Sélectionner une sous categorie',
                'attr' => ['class' => 'form-control form-control-sm select2'],
            ])
            ->add('image', FileType::class, [
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '5M', // Taille maximale de 1 Mo
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/pjpeg', // Ajout d'un type MIME alternatif
                            'image/png',
                            'image/avif',
                        ],
                        'mimeTypesMessage' => 'Fichier non valide! Veuillez télécharger une image au format JPEG ou PNG.',
                    ]),
                ],
            ])
            ->add('images', FileType::class, [
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
                'multiple' => true,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new All([
                        new File([
                            'maxSize' => '5M', // Taille maximale de 1 Mo
                            'mimeTypes' => [
                                'image/jpeg',
                                'image/pjpeg', // Ajout d'un type MIME alternatif
                                'image/png',
                                'image/avif',
                            ],
                            'mimeTypesMessage' => 'Fichier non valide! Veuillez télécharger une image au format JPEG ou PNG.',
                        ]),
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'allow_file_upload' => true
        ]);
    }
}
