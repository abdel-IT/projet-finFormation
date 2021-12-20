<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseCreateType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{


    private $classeRepository;
    private $entityManager;
    public function __construct(ClasseRepository $classeRepository, EntityManagerInterface $entityManager)
    {
        $this->classeRepository = $classeRepository;
        $this->entityManager = $entityManager;
    }
    #[Route('/class', name: 'class_list')]
    public function jsonTest(Request $request): Response
    {

        $classes=$this->classeRepository->findAll();
        return $this->json($classes);
    }

    #[Route('/classes', name: 'classe_list')]
    public function index(PaginatorInterface $paginator,Request $request): Response
    {

        $classes=$this->classeRepository->findAll();
                       // Paginate the results of the query
                       $classes = $paginator->paginate(
                        // Doctrine Query, not results
                        $classes,
                        // Define the page parameter
                        $request->query->getInt('page',1),
                        // Items per page
                        10 );
        return $this->render('classe/list.html.twig', ['classes' => $classes]);
    }


    #[Route('/classe/add', name: 'classe_add')]

    public function add( Request $request): Response
    {
        $classe = new Classe();
        $formclasse = $this->createForm(ClasseCreateType::class, $classe);
        $formclasse->handleRequest($request);
        if ($formclasse->isSubmitted() && $formclasse->isValid()) {
            $classe = $formclasse->getData();
            $this->entityManager->persist($classe);
            $this->entityManager->flush();
            // dd($classe);
            return $this->redirectToRoute('classe_list');
        }
        return $this->render('classe/add.html.twig', ['formClasse' => $formclasse->createView()]);
    }

    #[Route('/classe/edit/{id}', name: 'classe_edit')] // list Classes
    #[Route('/classe/show/{id}', name: 'classe_show')] // list Classes d un parent

    public function showOne($id, Request $request)
    {
        $classe = $this->classeRepository->find($id);
        if (!$classe) {
            return $this->redirectToRoute('classe_list');
        }
        $currentRoute = $request->attributes->get('_route');
        if ($currentRoute == 'classe_edit')
            return $this->render('classe/edit.html.twig', ['classe' => $classe, 'show' => 'classe']);
        else
            return $this->render('classe/edit.html.twig', ['classe' => $classe, 'show' => 'parent']);
    }

    #[Route('/classe/update/{id}', name: 'classe_update')]
    #[Route('/classe/updateC/{id}', name: 'classe_updateC')]
   
   public function updateClasse($id,request $request): Response
   {
       $Classe=$this->classeRepository->find($id);
       if (!$Classe) {
           return $this->redirectToRoute('Classe_list');
       }
       $formClasse = $this->createForm(ClasseCreateType::class, $Classe);
       $formClasse->handleRequest($request);
       $Classe = $formClasse->getData();
       if ($formClasse->isSubmitted() && $formClasse->isValid()) {
        //    $Classe = $formClasse->getData();
           $this->entityManager->persist($Classe);
           $this->entityManager->flush();
           //dd($Classe->getParent()->getId());
           $currentRoute = $request->attributes->get('_route');
           if ($currentRoute == 'classe_update')
               return $this->redirectToRoute('classe_list');
           else
               return $this->redirectToRoute('classe_edit', ['id' => $Classe->getId()]);
       }
       return $this->render('Classe/update.html.twig', ['formClasse' => $formClasse->createView()]);
   }

   #[Route('/classe/delete/{id}', name: 'classe_delete')]

   public function deleteClasse($id)

   {
       $classe = $this->classeRepository->find($id);
       if ($classe) {
           $this->entityManager->remove($classe);
           $this->entityManager->flush();
       }

       //dd($data)
       return $this->redirectToRoute('classe_list');
   }





}
