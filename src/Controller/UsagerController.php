<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerForm;
use App\Repository\UsagerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/usager'
)]
final class UsagerController extends AbstractController
{
    #[Route(name: 'app_usager_index', methods: ['GET'])]
    public function index(UsagerRepository $usagerRepository): Response
    {
        return $this->render('usager/index.html.twig', [
            'usagers' => $usagerRepository->findAll(),
        ]);
    }

    #[Route(
        path: '/nouveaux',
        name: 'app_usager_new',
        methods: ['GET', 'POST']
    )]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $usager = new Usager();
        $form = $this->createForm(UsagerForm::class, $usager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($usager, $usager->getPassword());
            $usager->setPassword($hashedPassword);
            $entityManager->persist($usager);
            $entityManager->flush();

            return $this->redirectToRoute('app_usager_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('usager/new.html.twig', [
            'usager' => $usager,
            'form' => $form,
        ]);
    }

    #[Route(
        path: '/{id}',
        name: 'app_usager_show',
        methods: ['GET']
    )]
    public function show(Usager $usager): Response
    {
        return $this->render('usager/show.html.twig', [
            'usager' => $usager,
        ]);
    }

    #[Route(
        path: '/modifier/{id}',
        name: 'app_usager_edit',
        methods: ['GET', 'POST']
    )]
    public function edit(Request $request, Usager $usager, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(UsagerForm::class, $usager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($usager, $usager->getPassword());
            $usager->setPassword($hashedPassword);
            $entityManager->flush();

            return $this->redirectToRoute('app_usager_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('usager/edit.html.twig', [
            'usager' => $usager,
            'form' => $form,
        ]);
    }

    #[Route(
        path: '/supprimer/{id}',
        name: 'app_usager_delete',
        methods: ['POST']
    )]
    public function delete(Request $request, Usager $usager, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usager->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($usager);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_usager_index', [], Response::HTTP_SEE_OTHER);
    }
}
