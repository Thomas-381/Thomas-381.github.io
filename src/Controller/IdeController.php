<?php

namespace App\Controller;

use App\Entity\Ide;
use App\Form\IdeForm;
use App\Repository\IdeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/ide')]
final class IdeController extends AbstractController
{
    #[Route(name: 'app_ide_index', methods: ['GET'])]
    public function index(IdeRepository $ideRepository): Response
    {
        return $this->render('ide/index.html.twig', [
            'ides' => $ideRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ide_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ide = new Ide();
        $form = $this->createForm(IdeForm::class, $ide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ide);
            $entityManager->flush();

            return $this->redirectToRoute('app_ide_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ide/new.html.twig', [
            'ide' => $ide,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ide_show', methods: ['GET'])]
    public function show(Ide $ide): Response
    {
        return $this->render('ide/show.html.twig', [
            'ide' => $ide,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ide_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ide $ide, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IdeForm::class, $ide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ide_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ide/edit.html.twig', [
            'ide' => $ide,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ide_delete', methods: ['POST'])]
    public function delete(Request $request, Ide $ide, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ide->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ide);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ide_index', [], Response::HTTP_SEE_OTHER);
    }
}
