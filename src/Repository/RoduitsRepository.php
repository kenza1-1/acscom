<?php

namespace App\Repository;

use App\Entity\Roduits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Roduits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Roduits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Roduits[]    findAll()
 * @method Roduits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Roduits::class);
    }

    // /**
    //  * @return Roduits[] Returns an array of Roduits objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Roduits
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
