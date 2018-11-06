<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Feed;
use App\Entity\Meal;
use App\Entity\Menu;
use App\Entity\Dish;
use App\Entity\SideDish;
use App\Entity\User;
use App\Entity\Order;

class UserController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return $this->render('user/home.html.twig');
    }
    /**
     * @Route("/menu")
     */
    public function menu(EntityManagerInterface $em)
    {
        $feedRepository = $em->getRepository(Feed::class);
        $feed = $feedRepository->findOneBy(['date_from' =>  \DateTime::createFromFormat( 'Y-m-d',date('Y-m-d', strtotime('next Monday')))]) ?? $this->saveNewMenu($em);

        $request = Request::createFromGlobals();
        $email = $request->request->get('email');
        $userRepository = $em->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $email]) ?? $this->registerNewUser($em, $email);

        $orderRepository = $em->getRepository(Order::class);
        $userOrders = $orderRepository->findUserOrders($user->getId());
        if ($userOrders[0]->getFeed() === $feed){
            $order = $orderRepository->findTodaysUserOrder($user->getId());
            return $this->render('user/ordered.html.twig', ['order' => $order]);
        }
        
        return $this->render('user/menu.html.twig');
    }

    protected function registerNewUser(EntityManagerInterface $em, $email)
    {
        $user = new User;
        $user->setEmail($email);
        $em->persist($user);
        $em->flush();
        return $user;
    }

    protected function getJsonResponse(string $url = 'https://www.sender.net/meals/', $method = 'GET')
    {
        $options = array(
            'http'=>array(
                'method'=> $method,
                'header'=>"Accept-language: en\r\n"
            )
        );
        $context = stream_context_create($options);
        $jsonContent = file_get_contents($url, false, $context);

        $encoder = new JsonEncoder();

        return $encoder->decode($jsonContent, 'json');
    }

    protected function saveNewMenu(EntityManagerInterface $em)
    {
        $currentFeed = $this->getJsonResponse()['feed'];
        $feed = new Feed;
        $feed->setDateFrom( \DateTime::createFromFormat( 'Y-m-d', date('Y-m-d', strtotime($currentFeed['date']['from'])) ) );
        $feed->setDateTo( \DateTime::createFromFormat( 'Y-m-d', date('Y-m-d', strtotime($currentFeed['date']['to'])) ) );
        foreach ($currentFeed['days'] as $day => $menuContent)
        {
            $menu = new Menu;
            $menu->setFeed($feed);
            $menu->setDay($day);
            $menu->setDate( \DateTime::createFromFormat( 'Y-m-d', date('Y-m-d', strtotime($menuContent['date'])) ) );
            $em->persist($menu);
            foreach ($menuContent['meals'] as $name => $mealContent)
            {
                if ($name === 'sideDishes')
                {
                    foreach ($mealContent['dishes'] as $sideContent){
                        $side = new SideDish;
                        $side->setMenu($menu);
                        $side->setTitle($sideContent['title']);
                        $side->setType($sideContent['type']);
                        $em->persist($side);

                    }
                    continue;
                }
                $meal = new Meal;
                $meal->setName($name);
                $meal->setMenu($menu);
                $em->persist($meal);
                foreach ($mealContent as $dishContent)
                {
                    $dish = new Dish;
                    $dish->setTitle($dishContent['title']);
                    $dish->setPrice($dishContent['price']);
                    $dish->setMeal($meal);
                    $em->persist($dish);
                }
            }
        }
        $em->persist($feed);
        $em->flush();

        return $feed;
    }
}
