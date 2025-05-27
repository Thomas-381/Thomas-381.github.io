<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/',
)]
final class DefaultController extends AbstractController
{
    #[Route(
        path: '/',
        name: 'app_default_index'
    )]
    public function index(ProjetRepository $projetRepository): Response
    {
        $projets = $projetRepository->findBy(['important' => 'true']);
        return $this->render('default/index.html.twig', [
                'projets' => $projets,
        ]);
    }
    #[Route(
        path: '/contact',
        name: 'app_default_contact'
    )]
    public function contact(): Response
    {
        return $this->render('default/contact.html.twig', [
        ]);
    }
}
