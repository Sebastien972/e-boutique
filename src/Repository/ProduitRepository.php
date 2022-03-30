<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    // /**
    // * @return Produit[] Returns an array of Produit objects
    // */
    // public function findCategorie($categorie = null)
    // {
    //     $query =$this->createQueryBuilder('p');

    //     if($categorie ==! null){
    //         // $query->join('p.categories', 'c')
    //         ->andWhere('p.id = :categorie')
    //         ->setParameter(":categorie", $categorie)
    //         ;
    //     }


    //     // return $query->getQuery()->getResult();
    // }


    public function getPaginatedProduit($page, $limit, $filters = null)
    {

        $query = $this->createQueryBuilder('p')
        ->select('c','p')
        ->leftjoin('p.categorie', 'c');

        if ($filters != null ) {
            $query->where('c IN (:cats)')
            ->setParameter('cats', array_values($filters));
        }
        
        $query->setFirstResult(($page * $limit)- $limit)
        ->setMaxResults($limit)
        ;

        return $query->getQuery()->getResult();

    }




    
   

    public function getTotalProduit($filters = null)
    {
        $query = $this->createQueryBuilder('p')
            ->select('COUNT(p)')
            ->join('p.categorie', 'c');
        ;
        if ($filters != null ) {
            $query->where('c IN (:cats)')
            ->setParameter('cats', array_values($filters));
        }
        
        return $query->getQuery()->getSingleScalarResult();

    }

    public function search($mots)
    {
        $query = $this->createQueryBuilder('p');

        if ($mots != null ) {
            $query->where('MATCH_AGAINST(p.nom, p.description) AGAINST(:mots boolean) >0')
            ->setParameter('mots', $mots);
        }

        return $query->getQuery()->getResult();


    }

}
