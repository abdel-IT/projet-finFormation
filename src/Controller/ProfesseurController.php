<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurCreateType;
use App\Repository\ClasseRepository;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{

    private $entityManager;
    private $professeurRepository;
    private $classeRepository;
    public function __construct(EntityManagerInterface $entityManager,ProfesseurRepository $professeurRepository,ClasseRepository $classeRepository)
    {
        $this->entityManager = $entityManager;
        $this->professeurRepository = $professeurRepository;
        $this->classeRepository=$classeRepository;
    }


    #[Route('/professeur/add', name: 'professeur_add')]

    public function add(Request $request): Response
    {
        $professeur = new Professeur();
        $formProfesseur = $this->createForm(ProfesseurCreateType::class, $professeur);
        $formProfesseur->handleRequest($request);
        if ($formProfesseur->isSubmitted() && $formProfesseur->isValid()) {
            $professeur = $formProfesseur->getData();
            $this->entityManager->persist($professeur);
            $this->entityManager->flush();
            // dd($formProfesseur);
            return $this->redirectToRoute('professeur_add');
        }
        return $this->render('professeur/add.html.twig', ['formProfesseur' => $formProfesseur->createView()]);
    }

    #[Route('/professeurs', name: 'professeur_list')]
    public function index(PaginatorInterface $paginator,Request $request): Response
    {
        $professeurs=$this->professeurRepository->findAll();
                // Paginate the results of the query
                $professeurs = $paginator->paginate(
                    // Doctrine Query, not results
                    $professeurs,
                    // Define the page parameter
                    $request->query->getInt('page',1),
                    // Items per page
                    5
                );
        return $this->render('professeur/list.html.twig', ['professeurs' => $professeurs]);
    }

    #[Route('/professeur/edit/{id}', name: 'professeur_edit')]

    public function showOne($id, ClasseRepository $classerepository)
    {
        //dd($professeur);
        $professeur = $this->professeurRepository->find($id);
        if (!$professeur) {
            return $this->redirectToRoute('professeur_list');
        }
        //$classes = $classerepository->findByIdt($professeur->getId());
        return $this->render('professeur/edit.html.twig', ['professeur' => $professeur, ]);
    }

    #[Route('/professeur/delete/{id}', name: 'professeur_delete')]

    public function deleterofesseur($id)

    {
        {
            $professeur = $this->professeurRepository->find($id);
            if ($professeur) {
                $this->entityManager->remove($professeur);
                $this->entityManager->flush();
            }
    
            //dd($data)
            return $this->redirectToRoute('professeur_list');
        }

        //dd($data)
        return $this->redirectToRoute('professeur_list');
    }
    #[Route('/professeur/update/{id}', name: 'professeur_update')]
    #[Route('/professeur/update/{id}', name: 'professeur_updateC')]
    public function updateProfesseur(Professeur $professeur = null, Request $request): Response
    {
        if (!$professeur) {
            return $this->redirectToRoute('professeur_list');
        };
        $formProfesseur = $this->createForm(professeurCreateType::class, $professeur);
        $formProfesseur->handleRequest($request);
        if ($formProfesseur->isSubmitted() && $formProfesseur->isValid()) {
            $professeur = $formProfesseur->getData();
            $this->entityManager->persist($professeur);
            $this->entityManager->flush();
            //dd($data)
            // $currentRoute = $request->attributes->get('_route');
            // if ($currentRoute == 'eleve_update')
            //     return $this->redirectToRoute('professeur_list');
            // else
                return $this->redirectToRoute('professeur_edit', ['id' => $professeur->getId()]);
        }
        return $this->render('professeur/update.html.twig', ['formProfesseur' => $formProfesseur->createView()]);
    }
}
