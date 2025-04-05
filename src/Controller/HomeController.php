<?php

namespace App\Controller;

use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly ProductRepository  $productRepository,
    )
    {
    }

    #[Route('/boutique', name: 'boutique')]
    public function index(): Response
    {
        $filters = $this->productRepository->findByFilters();
        return $this->render('home/index.html.twig', [
            'filters' => $filters,
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
        $categories = $this->categoryRepository->findAll();
        foreach ($categories as $category) {
            $dash = $this->productRepository->findBySomeField($category->getId());
        }
        return $this->render('admin/index.html.twig', [
            'dash' => $dash,
        ]);
    }
}
