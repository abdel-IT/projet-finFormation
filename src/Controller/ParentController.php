<?php

namespace App\Controller;

use App\Entity\Eleve;
use DateTimeImmutable;
use App\Entity\Parents;
use App\Form\ParentCreateType;
use App\Repository\EleveRepository;
use App\Repository\ParentsRepository;
use App\Repository\PaiementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


// #[Route('/parents')]

class ParentController extends AbstractController
{

    private $parentsRepository;
    private $entityManager;
    public function __construct(ParentsRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->parentsRepository = $repository;
        $this->entityManager = $entityManager;
    }
    // ++++++++++++++++++++++++++++++
    #[Route('parents', name: 'parent_list')]

    public function getAll(Request $request): Response
    {
        //dd($request);
        $motCles = $request->get('motCles');
        $optradio = $request->get('optradio');
        //dump($request);
        if ($motCles) //<> null
        {
            switch ($optradio) {
                case 1:
                    $parents = $this->parentsRepository->findBy(array('nomFamille' => $motCles));
                    break;
                case 2:
                    $parents = $this->parentsRepository->findBy(array('id' => $motCles));
                    break;
                case 3:
                    $parents = $this->parentsRepository->findBy(array('gsmPere' => $motCles));
                    break;
                default:
                    $parents = $this->parentsRepository->findAll();
            }
            // dump($parents);
            //  if($parents )
            //  {

            //      return $this->render('parents/list.html.twig', ['parents' => $parents]);
            // }
        } else 
        {
            $parents = $this->parentsRepository->findAll();
        }

        return $this->render('parents/list.html.twig', ['parents' => $parents]);
    }



    // +++++++++++++++++++++++++++++++++

    #[Route('/parent/add', name: 'parent_add')]

    public function add(Request $request): Response
    {
        $parent = new Parents();
        $form = $this->createForm(ParentCreateType::class, $parent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parent = $form->getData();
            $parent->setDateCreationAt(new DateTimeImmutable());
            $this->entityManager->persist($parent);
            $this->entityManager->flush();
            //dd($data)
            return $this->redirectToRoute('parent_list');
        }
        return $this->render('parents/add.html.twig', ['form' => $form->createView()]);
    }
    // +++++++++++++++++++++++++++++++++++++++++++++++
    #[Route('/parent/edit/{id}', name: 'parent_edit')]

    public function showOne($id, EleveRepository $eleverepository,PaiementRepository $paiementRepository)
    {
        //dd($parent);
        $parent = $this->parentsRepository->find($id);
        if (!$parent) {
            return $this->redirectToRoute('parent_list');
        }
        $eleves = $eleverepository->findByIdParent($parent);
        $dejaPayer=$paiementRepository->totalPaiements($id);
        $detailsPaiements=$paiementRepository->DetailsPaiements($id);
        
        //dd($dejaPayer);
        return $this->render('parents/edit.html.twig', ['parent' => $parent, 'eleves' => $eleves,'dejaPayer'=>$dejaPayer,'detailsPaiements'=>$detailsPaiements]);
    }

    // +++++++++++++++++++++++++++++++++++++++++++++++++++

    #[Route('/parent/update/{id}', name: 'parent_update')]

    public function updateParent(Parents $parent = null, Request $request): Response
    {
        if (!$parent) {
            return $this->redirectToRoute('parent_list');
        };
        $form = $this->createForm(ParentCreateType::class, $parent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parent = $form->getData();
            $this->entityManager->persist($parent);
            $this->entityManager->flush();
            //dd($data)
            return $this->redirectToRoute('parent_list');
        }
        
        return $this->render('parents/update.html.twig', ['form' => $form->createView()]);
    }
    // +++++++++++++++++++++++++++++++++

    #[Route('/parent/delete/{id}', name: 'parent_delete')]

    public function deleteParent($id)

    {
        $parent = $this->parentsRepository->find($id);
        if ($parent) {
            $this->entityManager->remove($parent);
            $this->entityManager->flush();
        }

        //dd($data)
        return $this->redirectToRoute('parent_list');
    }
}
