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

    public function findAvailableSidesForAWeek()
    {
        return $this->createQueryBuilder('s')
            ->join('s.menu', 'm')
            ->join('m.feed', 'f')
            ->where('f.date_from = :date')
            ->setParameter('date', date('Y-m-d', strtotime('next Monday')))
            ->getQuery()
            ->getResult()
        ;
    }

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
