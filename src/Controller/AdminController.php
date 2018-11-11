<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Order;
use App\Entity\User;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return $this->render('admin/main.html.twig');
    }
    /**
     * @Route("/admin/user/{id}")
     */
    public function userOrder($id, EntityManagerInterface $em)
    {
        $orderRepository = $em->getRepository(Order::class);
        $userRepository = $em->getRepository(User::class);
        $userOrders = $orderRepository->findUserOrdersInfo($id);
        return $this->render('admin/user.html.twig', ['orders' => $userOrders, 'email' => $userRepository->findOneBy(['id' => $id])->getEmail()]);

        if ($userOrders){
            $order = $orderRepository->findTodaysUserOrder($user->getId());
            return $this->render('user/ordered.html.twig', ['order' => $order]);
        }

        return $this->render('admin/admin.html.twig');
    }
}
