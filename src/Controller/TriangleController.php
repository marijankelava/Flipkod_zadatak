<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Triangle;

class TriangleController extends AbstractController
{
    /**
     * @Route("/triangle/{a}/{b}/{c}", name="app_triangle", defaults={"a"=null, "b"=null, "c"=null}, methods={"GET"})
     */
    public function createTriangle(Request $request): JsonResponse
    {
        $parameters = $request->query->all();

        if (!isset($parameters['a']['b']['c'])) {
            echo "Please enter triangle side values";
            exit;
        }

        $a = $parameters['a'];
        $b = $parameters['b'];
        $c = $parameters['c'];

        $triangle = new Triangle();
        $triangle->setA($a);
        $triangle->setB($b);
        $triangle->setC($c);

        return $this->json([
            'controller_name' => 'TriangleController',
        ]);
    }
}
