<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Paiement;
use App\Form\PaiementCreateType;
use App\Repository\ParentsRepository;
use App\Repository\PaiementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'paiement')]
    public function index(): Response
    {
        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
        ]);
    }
    #[Route('/paiement/add/{id_parent}', name: 'paiement_add')]

    public function add($id_parent, Request $request,ParentsRepository $parentsRepository,EntityManagerInterface $entityManager): Response
    {


        $parent = $parentsRepository->find($id_parent);

        $paiement = new Paiement();
        $paiement->setParent($parent);

        $formPaiement = $this->createForm(PaiementCreateType::class, $paiement);
        $formPaiement->handleRequest($request);
        if ($formPaiement->isSubmitted() && $formPaiement->isValid()) {
            $paiement = $formPaiement->getData();
            $paiement->setDatePaiement(new DateTimeImmutable());
            $entityManager->persist($paiement);
            $entityManager->flush();
            // dd($paiement);
            return $this->redirectToRoute('parent_edit', ['id' => $id_parent]);
        }
        return $this->render('paiement/add.html.twig', ['formPaiement' => $formPaiement->createView()]);
    }
}
