<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\SelectedSide;
use App\Entity\OrderedDish;
use App\Entity\Order;
use App\Entity\User;
use App\Entity\Dish;
use App\Entity\Feed;
use App\Entity\SideDish;

class ApiController extends AbstractController
{
  
     /**
     * @Route("/user/order")
     */
    public function order(EntityManagerInterface $em)
    {
        $request = Request::createFromGlobals();
        $order = $request->request->get('order');
        $email = $request->request->get('email');
        $feedId = $request->request->get('feed');

        $userRepository = $em->getRepository(User::class);
        $feedRepository = $em->getRepository(Feed::class);
        $dishRepository = $em->getRepository(Dish::class);
        $sideRepository = $em->getRepository(SideDish::class);

        $feed = $feedRepository->findOneBy(['id' => $feedId]);
        $user = $userRepository->findOneBy(['email' => $email]);

        $orderEntity = new Order;
        $orderEntity->setUser($user);
        $orderEntity->setFeed($feed);

        foreach (json_decode($order) as $orderedDish) {
            $orderedDishEntity = new OrderedDish;
            $orderedDishEntity->setOrderId($orderEntity);
            $dish = $dishRepository->findOneBy(['id' => $orderedDish->dish]);
            $orderedDishEntity->setDish($dish);
            $em->persist($orderedDishEntity);
            foreach ($orderedDish->sides as $selectedSide){
                $side = $sideRepository->findOneBy(['id' => $selectedSide]);
                $selectedSideEntity = new SelectedSide;
                $selectedSideEntity->setSideDish($side);
                $selectedSideEntity->setOrderedDish($orderedDishEntity);
                $em->persist($selectedSideEntity);
            }
        }

        $em->persist($orderEntity);
        $em->flush();

        return $this->json(['status' => 'success']);
    }
    /**
     * @Route("/users/{email}", defaults={"email": ""})
     */
    public function users($email, EntityManagerInterface $em)
    {
        $userRepository = $em->getRepository(User::class);
        $users = $userRepository->findUsersByEmail($email);
        return $this->render('admin/users.html.twig', ['users' => $users]);
    }
    /**
     * @Route("/ordered_dish/{id}", methods={"DELETE"})
     */
    public function removeOrderedDish($id, EntityManagerInterface $em)
    {
        $orderedDishRepository = $em->getRepository(OrderedDish::class);
        $orderedDish = $orderedDishRepository->findOneBy(['id' => $id]);
        $orderedDish->setOrderId(null);
        $em->flush();
        return $this->render('api/string.html.twig', ['string' => 'Successfully removed dish from order']);
    }
}
