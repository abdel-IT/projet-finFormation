<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NiveauScolaireController extends AbstractController
{
    #[Route('/niveau/scolaire', name: 'niveau_scolaire')]
    public function index(): Response
    {
        return $this->render('niveau_scolaire/index.html.twig', [
            'controller_name' => 'NiveauScolaireController',
        ]);
    }
}
