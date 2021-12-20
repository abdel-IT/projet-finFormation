<?php

namespace App\Repository;

use App\Entity\Paiement;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Paiement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paiement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paiement[]    findAll()
 * @method Paiement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaiementRepository extends ServiceEntityRepository
{
    private EntityManager $entityManager;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paiement::class);
    }

    // /**
    //  * @return Paiement[] Returns an array of Paiement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Paiement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function totalPaiements($Id_parent)
    {
        // return $this->createQueryBuilder('p')
        // ->addSelect('SUM(p.montant) as total')
        // ->andWhere('p.parent_id = :id')
        // ->setParameter('id', $value)
        // ->getQuery()
        // ->getOneOrNullResult();

        $dql = "SELECT SUM(pai.montant) as total FROM App\Entity\Paiement pai join pai.parent par  WHERE par.id = :Id_parent";
        $query = $this->_em->createQuery($dql);
        $query->setParameter("Id_parent", $Id_parent);

        return $query->getOneOrNullResult();
    }




    
    public function DetailsPaiements($Id_parent)
    {

        $dql = "SELECT pai  FROM App\Entity\Paiement pai join pai.parent par  WHERE par.id = :Id_parent";

        $query = $this->_em->createQuery($dql);
        $query->setParameter("Id_parent", $Id_parent);
        return $query->getResult();
    }
}
