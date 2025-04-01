<?php

namespace App\Controller;

use App\Entity\Admin\Product;
use App\Entity\Admin\ProductImage;
use App\Entity\User;
use App\Form\ProductType;
use App\Repository\Admin\ProductRepository;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Flasher\Prime\FlasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/product', name: 'app_product_')]
final class ProductController extends AbstractController
{
    public function __construct(
        private readonly FlasherInterface $flasher
    )
    {
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager, FileUploaderService $fileUploader, SluggerInterface $slugger): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {

            $product->setUser($user);
            /** @var UploadedFile $imageFile */
            $image_file = $form->get('image')->getData();
            if ($image_file) {
                $imageFileName = $fileUploader->upload($image_file);
                $product->setImageUrl($imageFileName);
            }

            $images = $form->get('images')->getData();
            foreach ($images as $image) {
                if ($image instanceof UploadedFile) {
                    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                    $image->move(
                        $this->getParameter('products_directory'),
                        $newFilename
                    );

                    $productImage = new ProductImage();
                    $productImage->setImageUrl($newFilename);
                    $productImage->setProduct($product);
                    $product->addImage($productImage);
                }
            }

            $manager->persist($product);
            $manager->flush();
            $this->flasher->addSuccess('Produit ajouté avec succès!');
            return $this->redirectToRoute('app_product_index');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $manager, Product $product, FileUploaderService $fileUploader, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUser($user);
            /** @var UploadedFile $imageFile */
            $image_file = $form->get('image')->getData();
            if ($image_file) {
                $imageFileName = $fileUploader->upload($image_file);
                $product->setImageUrl($imageFileName);
            }

            $images = $form->get('images')->getData();
            foreach ($images as $image) {
                if ($image instanceof UploadedFile) {
                    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                    $image->move(
                        $this->getParameter('products_directory'),
                        $newFilename
                    );

                    $productImage = new ProductImage();
                    $productImage->setImageUrl($newFilename);
                    $productImage->setProduct($product);
                    $product->addImage($productImage);
                }
            }
            $manager->persist($product);
            $manager->flush();
            $this->flasher->addSuccess('Produit modifié avec succès!');
            return $this->redirectToRoute('app_product_index');
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['POST', 'GET'])]
    public function delete(Product $product, EntityManagerInterface $manager): Response
    {
        $manager->remove($product);
        $manager->flush();
        $this->flasher->addSuccess('Produit supprimé avec succès!');
        return $this->redirectToRoute('app_product_index');
    }

}
