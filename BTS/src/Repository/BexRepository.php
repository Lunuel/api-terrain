<?php

namespace App\Repository;

use App\Entity\Bex;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bex|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bex|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bex[]    findAll()
 * @method Bex[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BexRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bex::class);
    }

    // /**
    //  * @return Bex[] Returns an array of Bex objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bex
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
