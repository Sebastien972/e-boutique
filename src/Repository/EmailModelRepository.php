<?php

namespace App\Repository;

use App\Entity\EmailModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmailModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmailModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmailModel[]    findAll()
 * @method EmailModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailModel::class);
    }

    // /**
    //  * @return EmailModel[] Returns an array of EmailModel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmailModel
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
