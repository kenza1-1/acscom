<?php

namespace App\Repository;

use App\Entity\Produits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function findArray($array){
        $qb=$this->createQueryBuilder('u')
        ->select('u')
        ->where('u.id IN (:array)')
        ->setParameter('array', $array);
        return $qb->getQuery()->getResult();
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    // /**
    //  * @return Produits[] Returns an array of Produits objects
    //  */
    
    public function findByCategorie($categorie)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->Where('p.categorie = :categorie')
            // ->andWhere('p.disponibilite = 1')
            ->setParameter('categorie', $categorie)
            ->orderBy('p.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Produits
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
