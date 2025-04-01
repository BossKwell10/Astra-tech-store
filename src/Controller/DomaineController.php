<?php

namespace App\Controller;

use App\Entity\Admin\Domaine;
use App\Entity\User;
use App\Form\DomaineType;
use App\Repository\Admin\DomaineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Flasher\Prime\FlasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/domaine', name: 'app_domaine_')]
final class DomaineController extends AbstractController
{

    public function __construct(
      private readonly FlasherInterface $flasher
    )
    {
    }

    #[Route('/index', name: 'index', methods: ['GET'])]
    public function index(DomaineRepository $domaineRepository): Response
    {
        $domaines = $domaineRepository->findAll();
        return $this->render('domaine/index.html.twig', [
            'domaines' => $domaines,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $domaine = new Domaine();
        $form = $this->createForm(DomaineType::class, $domaine);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $domaine->setUser($user);
            $manager->persist($domaine);
            $manager->flush();
            $this->flasher->success('Domaine ajouté avec succès.');
            return $this->redirectToRoute('app_domaine_index');
        }
        return $this->render('domaine/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Domaine $domaine, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(DomaineType::class, $domaine);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $domaine->setUser($user);
            $manager->persist($domaine);
            $manager->flush();
            $this->flasher->addSuccess('Domaine modifié avec succès');
            return $this->redirectToRoute('app_domaine_index');
        }

        return $this->render('domaine/edit.html.twig', [
            'domaine' => $domaine,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['POST', 'GET'])]
    public function delete(Domaine $domaine, EntityManagerInterface $manager): Response
    {
        $manager->remove($domaine);
        $manager->flush();
        flash()->addSuccess('Domaine supprimé avec succès.');
        return $this->redirectToRoute('app_domaine_index');
    }
}
