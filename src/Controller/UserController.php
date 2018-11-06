<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use App\Entity\Feed;

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
    public function menu()
    {
        $this->saveNewMenu();
        $request = Request::createFromGlobals();
        dump($request->request->get('emaial'));
        // exit();
        return $this->render('user/menu.html.twig');
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

    protected function saveNewMenu()
    {
        $currentFeed = $this->getJsonResponse();
        $feed = new Feed;
        $feed->setDateFrom( \DateTime::createFromFormat( 'Y-m-d', date('Y-m-d', strtotime($currentFeed['feed']['date']['from'] ))) );
        $feed->setDateTo( \DateTime::createFromFormat( 'Y-m-d', date('Y-m-d', strtotime($currentFeed['feed']['date']['to'] ))) );
       // $feed->setDateTo( \DateTime::createFromFormat( 'Y-m-d', date('Y-m-d', strtotime('next Monday'))) );
        dump($feed); exit();
    }
}
