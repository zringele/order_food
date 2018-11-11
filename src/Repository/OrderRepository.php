<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findUserOrders($user)
    {
        return $this->createQueryBuilder('o')
            ->join('o.user', 'u')
            ->join('o.feed', 'f')
            ->where('u.id = :user')
            // ->orWhere('f.date_from = :dateTwo')
            ->setParameter('user', $user)
            // ->setParameter('dateTwo', date('Y-m-d', strtotime('next Monday')))
            ->orderBy('f.date_from', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTodaysUserOrder($userId)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 
            "SELECT 
                dish.title as dish_title,
                dish.price as dish_price,
                GROUP_CONCAT(side_dish.title) as side_titles
            FROM `order`
                JOIN user on user_id = user.id
                JOIN feed on feed_id = feed.id
                JOIN ordered_dish on order_id_id = `order`.id
                JOIN dish on dish_id = dish.id
                JOIN meal on meal_id = meal.id
                JOIN menu on menu_id = menu.id
                LEFT JOIN selected_side on ordered_dish_id = ordered_dish.id
                LEFT JOIN side_dish on side_dish_id = side_dish.id
            WHERE DATE(date) = CURDATE()
                AND user_id = :userId
            GROUP BY dish.id
            ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':userId' => $userId]);

        // returns an array of Product objects
        return $stmt->fetchAll();
    }

    public function findUserOrdersInfo($userId)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 
            "SELECT 
                dish.title as dish_title,
                dish.price as dish_price,
                GROUP_CONCAT(side_dish.title) as side_titles,
                menu.date as menu_date,
                ordered_dish.id as ordered_dish_id
            FROM `order`
                JOIN user on user_id = user.id
                JOIN feed on feed_id = feed.id
                JOIN ordered_dish on order_id_id = `order`.id
                JOIN dish on dish_id = dish.id
                JOIN meal on meal_id = meal.id
                JOIN menu on menu_id = menu.id
                LEFT JOIN selected_side on ordered_dish_id = ordered_dish.id
                LEFT JOIN side_dish on side_dish_id = side_dish.id
                WHERE user_id = :userId
            GROUP BY ordered_dish.id
            ORDER BY menu.date DESC
            ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':userId' => $userId]);

        // returns an array of Product objects
        return $stmt->fetchAll();
    }

}
