<?php

namespace App\Repository;

use App\Entity\DishHasSide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DishHasSide|null find($id, $lockMode = null, $lockVersion = null)
 * @method DishHasSide|null findOneBy(array $criteria, array $orderBy = null)
 * @method DishHasSide[]    findAll()
 * @method DishHasSide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DishHasSideRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DishHasSide::class);
    }

    // /**
    //  * @return DishHasSide[] Returns an array of DishHasSide objects
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
    public function findOneBySomeField($value): ?DishHasSide
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
