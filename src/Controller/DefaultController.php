<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactForm;
use App\Repository\IdeRepository;
use App\Repository\LangageRepository;
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
    public function index(ProjetRepository $projetRepository, LangageRepository $langageRepository, IdeRepository $ideRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactForm::class, $contact, [
            'action' => $this->generateUrl('app_contact_new'),
            'method' => 'POST',
        ]);
        $projets = $projetRepository->findAll();
        $langage = $langageRepository->findAll();
        $ide = $ideRepository->findAll();
        return $this->render('default/index.html.twig', [
                'projets' => $projets,
                'langages' => $langage,
                'ides' => $ide,
                'form' => $form,
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
