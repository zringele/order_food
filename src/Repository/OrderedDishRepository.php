<?php

namespace App\Repository;

use App\Entity\OrderedDish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OrderedDish|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderedDish|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderedDish[]    findAll()
 * @method OrderedDish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderedDishRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OrderedDish::class);
    }

    // /**
    //  * @return OrderedDish[] Returns an array of OrderedDish objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderedDish
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
