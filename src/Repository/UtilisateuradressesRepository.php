<?php

namespace App\Repository;

use App\Entity\Utilisateuradresses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Utilisateuradresses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateuradresses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateuradresses[]    findAll()
 * @method Utilisateuradresses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateuradressesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateuradresses::class);
    }

    // /**
    //  * @return Utilisateuradresses[] Returns an array of Utilisateuradresses objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Utilisateuradresses
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
