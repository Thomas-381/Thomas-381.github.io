<?php

namespace App\Controller;

use App\Entity\Langage;
use App\Form\LangageForm;
use App\Repository\LangageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/langage')]
final class LangageController extends AbstractController
{
    #[Route(name: 'app_langage_index', methods: ['GET'])]
    public function index(LangageRepository $langageRepository): Response
    {
        return $this->render('langage/index.html.twig', [
            'langages' => $langageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_langage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $langage = new Langage();
        $form = $this->createForm(LangageForm::class, $langage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($langage);
            $entityManager->flush();

            return $this->redirectToRoute('app_langage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('langage/new.html.twig', [
            'langage' => $langage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_langage_show', methods: ['GET'])]
    public function show(Langage $langage): Response
    {
        return $this->render('langage/show.html.twig', [
            'langage' => $langage,
        ]);
    }

    #[Route(
        path: '/modifier/{id}',
        name: 'app_langage_edit',
        methods: ['GET', 'POST']
    )]
    public function edit(Request $request, LangageRepository $langageRepository, EntityManagerInterface $entityManager, int $id): Response
    {
        $langage = $langageRepository->find($id);
        $form = $this->createForm(LangageForm::class, $langage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($langage);
            $entityManager->flush();
            return $this->redirectToRoute('app_langage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('langage/edit.html.twig', [
            'langage' => $langage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_langage_delete', methods: ['POST'])]
    public function delete(Request $request, Langage $langage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$langage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($langage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_langage_index', [], Response::HTTP_SEE_OTHER);
    }
}
