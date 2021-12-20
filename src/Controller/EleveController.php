<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Entity\Classe;
use DateTimeImmutable;
use App\Form\EleveCreateType;
use App\Repository\EleveRepository;
use App\Repository\ClasseRepository;
use App\Repository\ParentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class EleveController extends AbstractController
{
    private $parentsRepository;
    private $eleveRepository;
    private $entityManager;
    public function __construct(ParentsRepository $parentsRepository, EleveRepository $eleveRepository, EntityManagerInterface $entityManager)
    {
        $this->parentsRepository = $parentsRepository;
        $this->eleveRepository = $eleveRepository;
        $this->entityManager = $entityManager;
    }
    // ++++++++++++++++++++++++++++++

    #[Route('/eleves', name: 'eleve_list')]
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        //dd($request);
        $motCles = $request->get('motCles');
        $optradio = $request->get('optradio');
        if ($motCles) //<> null
        {
            switch ($optradio) {
                case 1:
                    $eleves = $this->eleveRepository->findBy(array('prenom' => $motCles));
                    break;
                case 2:
                    $eleves = $this->eleveRepository->findBy(array('prenom' => $motCles));
                    break;
                case 3:
                    $eleves = $this->eleveRepository->findBy(array('dateNaissanceAt' => new \DateTime($motCles)));
                    break;
                default:
                    $eleves = $this->eleveRepository->findAll();
            }
        }
        else 
        {
            $eleves = $this->eleveRepository->findAll();
        }
        
        // Paginate the results of the query
        $eleves = $paginator->paginate(
            // Doctrine Query, not results
            $eleves,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );
        return $this->render('eleve/list.html.twig', ['eleves' => $eleves]);
    }

    #[Route('/eleve/add/{id_parent}', name: 'eleve_add')]

    public function add($id_parent, Request $request): Response
    {
        $parent = $this->parentsRepository->find($id_parent);

        $eleve = new Eleve();
        $eleve->setParent($parent);

        $formEleve = $this->createForm(EleveCreateType::class, $eleve);
        $formEleve->handleRequest($request);
        if ($formEleve->isSubmitted() && $formEleve->isValid()) {
            $eleve = $formEleve->getData();
            $eleve->setDateInscriptionAt(new DateTimeImmutable());
            $this->entityManager->persist($eleve);
            $this->entityManager->flush();
            // dd($eleve);
            return $this->redirectToRoute('parent_edit', ['id' => $id_parent]);
        }
        return $this->render('eleve/add.html.twig', ['formEleve' => $formEleve->createView()]);
    }


    #[Route('/eleve/edit/{id}', name: 'eleve_edit')] // list eleves
    #[Route('/eleve/show/{id}', name: 'eleve_show')] // list eleves d un parent

    public function showOne($id, Request $request)
    {
        $eleve = $this->eleveRepository->find($id);
        if (!$eleve) {
            return $this->redirectToRoute('eleve_list');
        }
        $currentRoute = $request->attributes->get('_route');
        if ($currentRoute == 'eleve_edit')
            return $this->render('eleve/edit.html.twig', ['eleve' => $eleve, 'show' => 'eleve']);
        else
            return $this->render('eleve/edit.html.twig', ['eleve' => $eleve, 'show' => 'parent']);
    }


    #[Route('/eleve/update/{id}', name: 'eleve_update')]
    #[Route('/eleve/updateP/{id}', name: 'eleve_updateP')]

    public function updateEleve($id, request $request): Response
    {
        $eleve = $this->eleveRepository->find($id);
        if (!$eleve) {
            return $this->redirectToRoute('eleve_list');
        }
        $formEleve = $this->createForm(EleveCreateType::class, $eleve);
        $formEleve->handleRequest($request);
        $eleve = $formEleve->getData();
        if ($formEleve->isSubmitted() && $formEleve->isValid()) {
            $eleve = $formEleve->getData();
            $this->entityManager->persist($eleve);
            $this->entityManager->flush();
            //dd($eleve->getParent()->getId());<
            $currentRoute = $request->attributes->get('_route');
            if ($currentRoute == 'eleve_update')
                return $this->redirectToRoute('eleve_list');
            else
                return $this->redirectToRoute('parent_edit', ['id' => $eleve->getParent()->getId()]);
        }
        return $this->render('eleve/update.html.twig', ['formEleve' => $formEleve->createView()]);
    }

    // +++++++++++++++++++++++++++++++++

    #[Route('/eleve/delete/{id}', name: 'eleve_delete')]

    public function deleteEleve($id)

    {
        $eleve = $this->eleveRepository->find($id);
        if ($eleve) {
            $this->entityManager->remove($eleve);
            $this->entityManager->flush();
        }

        //dd($data)
        return $this->redirectToRoute('eleve_list');
    }
}
