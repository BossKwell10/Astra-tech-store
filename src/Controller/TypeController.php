<?php

namespace App\Controller;

use App\Entity\Admin\Type;
use App\Entity\User;
use App\Form\TypeFomType;
use App\Repository\Admin\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Flasher\Prime\FlasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/type', name: 'app_type_')]
final class TypeController extends AbstractController
{
    public function __construct(
        private readonly FlasherInterface $flasher
    )
    {
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(TypeRepository $typeRepository): Response
    {
        $types = $typeRepository->findAll();
        return $this->render('type/index.html.twig', [
            'types' => $types,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $type = new Type();
        $form = $this->createForm(TypeFomType::class, $type);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {

            $type->setUser($user);
            $manager->persist($type);
            $manager->flush();
            $this->flasher->addSuccess('Sous catégorie ajoutée avec success.');
            return $this->redirectToRoute('app_type_index');
        }
        return $this->render('type/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Type $type, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(TypeFomType::class, $type);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $type->setUser($user);
            $manager->persist($type);
            $manager->flush();
            $this->flasher->addSuccess('Sous categorie modifiée avec success.');
            return $this->redirectToRoute('app_type_index');
        }

        return $this->render('type/edit.html.twig', [
            'form' => $form->createView(),
            'type' => $type,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Type $type, EntityManagerInterface $manager): Response
    {
        $manager->remove($type);
        $manager->flush();
        $this->flasher->addSuccess('Sous catégorie supprimée avec succès!');
        return $this->redirectToRoute('app_type_index');
    }
}
