<?php

namespace App\Repository;

use App\Entity\SelectedSide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SelectedSide|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelectedSide|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelectedSide[]    findAll()
 * @method SelectedSide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectedSideRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SelectedSide::class);
    }

    // /**
    //  * @return SelectedSide[] Returns an array of SelectedSide objects
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
    public function findOneBySomeField($value): ?SelectedSide
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
