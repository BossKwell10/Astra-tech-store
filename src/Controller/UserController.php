<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Flasher\Prime\FlasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/user', name: 'app_user_')]
final class UserController extends AbstractController
{

    public function __construct(
        private readonly FlasherInterface $flasher
    )
    {
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(UserRepository $repository): Response
    {

        $users = $repository->findByType(["Gestionnaire"]);
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($user, $form->get('plainPassword')->getData());
            $user->setPassword($hashedPassword);
            $type = $form->get('role')->getData();
            $user->setRoles([$type]);
            $type_user = ucfirst(strtolower(str_replace("ROLE_", "", $type)));
            $user->setTypeUser($type_user);
            $manager->persist($user);
            $manager->flush();
            $this->flasher->addSuccess("Utilisateur ajouté avec success");
            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $manager, User $user, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($user, $form->get('plainPassword')->getData());
            $user->setPassword($hashedPassword);
            $type = $form->get('role')->getData();
            $user->setRoles([$type]);
            $type_user = ucfirst(strtolower(str_replace("ROLE_", "", $type)));
            $user->setTypeUser($type_user);
            $manager->persist($user);
            $manager->flush();
            $this->flasher->addSuccess("Utilisateur modifié avec success");
            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET', 'POST'])]
    public function delete(EntityManagerInterface $manager, User $user): Response
    {
        $manager->remove($user);
        $manager->flush();
        $this->flasher->addSuccess("Utilisateur supprimé avec success");
        return $this->redirectToRoute('app_user_index');
    }
}
