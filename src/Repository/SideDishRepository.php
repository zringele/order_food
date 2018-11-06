<?php

namespace App\Repository;

use App\Entity\SideDish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SideDish|null find($id, $lockMode = null, $lockVersion = null)
 * @method SideDish|null findOneBy(array $criteria, array $orderBy = null)
 * @method SideDish[]    findAll()
 * @method SideDish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SideDishRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SideDish::class);
    }

    // /**
    //  * @return SideDish[] Returns an array of SideDish objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SideDish
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
