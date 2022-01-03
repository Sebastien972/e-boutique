<?php

namespace App\Repository;

use App\Entity\DetaileCart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetaileCart|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetaileCart|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetaileCart[]    findAll()
 * @method DetaileCart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetaileCartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetaileCart::class);
    }

    // /**
    //  * @return DetaileCart[] Returns an array of DetaileCart objects
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
    public function findOneBySomeField($value): ?DetaileCart
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
