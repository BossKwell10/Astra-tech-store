<?php

namespace App\Controller;

use App\Entity\Admin\Category;
use App\Entity\User;
use App\Form\CategoryType;
use App\Repository\Admin\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Flasher\Prime\FlasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/category', name: 'app_category_')]
final class CategoryController extends AbstractController
{
    public function __construct(
        private readonly FlasherInterface $flasher
    )
    {
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $category->setUser($user);
            $manager->persist($category);
            $manager->flush();
            $this->flasher->addSuccess('Catégorie ajoutée avec success!');
            return $this->redirectToRoute('app_category_index');
        }
        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $category->setUser($user);
            $manager->persist($category);
            $manager->flush();
            $this->flasher->addSuccess('Catégories modifié avec success!');
            return $this->redirectToRoute('app_category_index');
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(Category $category, EntityManagerInterface $manager): Response
    {
        $manager->remove($category);
        $manager->flush();
        $this->flasher->addSuccess('Catégorie supprimée avec success!');
        return $this->redirectToRoute('app_category_index');
    }
}
