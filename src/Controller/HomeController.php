<?php

namespace App\Controller;

use App\Entity\Admin\Product;
use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\ProductRepository;
use App\Repository\Admin\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly ProductRepository  $productRepository,
        private readonly TypeRepository     $typeRepository,
    )
    {
    }

    #[Route('/boutique', name: 'boutique')]
    public function index(): Response
    {
        $filters = $this->productRepository->findByFilters();
        $categories = $this->categoryRepository->findAll();
        return $this->render('home/index.html.twig', [
            'filters' => $filters,
            'categories' => $categories
        ]);
    }

    #[Route('/boutique/product/{id}', name: 'product_detail')]
    public function showProduct(Product $product): Response
    {
        $imageList = [$product->getImageUrl()]; // commence par l’image principale

        foreach ($product->getImages() as $productImage) {
            $imageList[] = $productImage->getImageUrl();
        }

        return $this->render('home/product.html.twig', [
            'product' => $product,
            'images' => $imageList,
        ]);
    }

    #[Route('/', name: 'hero')]
    public function hero(): Response
    {
        return $this->render('home/hero.html.twig');
    }

    #[Route('/admin', name: 'admin_home')]
    public function adminIndex(): Response
    {
        $dash = [];
        $categories = $this->typeRepository->findCategories();
        foreach ($categories as $category) {
            $product_counter = $this->productRepository->findCountByFilters($category['category_name']);
            $dash[] = [
                'category_name' => $category['category_name'],
                'product_count' => $product_counter,
            ];
        }

        return $this->render('admin/index.html.twig', [
            'dash' => $dash,
        ]);
    }

    #[Route('/produits', name: 'produits_liste')]
    public function liste(Request $request, ProductRepository $repo): Response
    {
        $filtres = $request->query->all();
        $produits = $repo->findWithFilters($filtres);
        $categories = $this->categoryRepository->findAll();

        if ($request->isXmlHttpRequest()) {
            return $this->render('home/_liste.html.twig', [
                'filters' => $produits
            ]);
        }

        return $this->render('home/index.html.twig', [
            'filters' => $produits,
            'categories' => $categories
        ]);
    }

}
