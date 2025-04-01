<?php

namespace App\Controller;

use App\Entity\Campagny;
use App\Entity\User;
use App\Form\CompanyType;
use App\Repository\CampagnyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/campagny', name: 'app_campagny_')]
final class CampagnyController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CampagnyRepository $campagnyRepository): Response
    {
        $campagny = $campagnyRepository->findOneBy([], ['id' => 'ASC']);
        return $this->render('campagny/index.html.twig', [
            'compagny' => $campagny,
        ]);
    }

    #[isGranted('ROLE_SUPER_ADMIN')]
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $campagny = $manager->getRepository(Campagny::class)->findOneBy([], ['id' => 'ASC']);
        if ($campagny) {
            flash()->addInfo('Une entreprise est existante merci de la supprimer au préalable !');
            return $this->redirectToRoute('app_campagny_index');
        }
        $compagny = new Campagny();
        $form = $this->createForm(CompanyType::class, $compagny);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($compagny);
            $manager->flush();
            flash()->addSuccess('Société crée avec succès');
            return $this->redirectToRoute('app_campagny_index');
        }
        return $this->render('campagny/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Campagny $campagny, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CompanyType::class, $campagny);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($campagny);
            $manager->flush();
            flash()->addSuccess('Société modifié avec succès');
            return $this->redirectToRoute('app_campagny_index');
        }

        return $this->render('campagny/edit.html.twig', [
            'form' => $form->createView(),
            'campagny' => $campagny,
            'editing' => true
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['POST', 'GET'])]
    public function delete(Campagny $compagny, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($compagny);
        $entityManager->flush();
        flash()->addSuccess('Catégorie supprimé avec succès');
        return $this->redirectToRoute('app_campagny_index', [], Response::HTTP_SEE_OTHER);
    }

}
