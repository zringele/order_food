<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $request = Request::createFromGlobals();
        dump($request->request->get('emaial'));
        // exit();
        return $this->render('user/menu.html.twig');
    }
}
