<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CircleController extends AbstractController
{
    /**
     * @Route("/circle/{radius}", name="app_circle", defaults={"radius"=null}, methods={"GET"})
     */
    public function index(): Response
    {
        /*return $this->render('circle/index.html.twig', [
            'controller_name' => 'CircleController',
        ]);*/

        return $this->json([
            'message' => 'Welcome to your new controller',
            'path' => 'src/Controller/CircleController'
        ]);
    }
}
