<?php

namespace App\Repository;

use App\Entity\DetaileCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetaileCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetaileCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetaileCommande[]    findAll()
 * @method DetaileCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetaileCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetaileCommande::class);
    }

    // /**
    //  * @return DetaileCommande[] Returns an array of DetaileCommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetaileCommande
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
