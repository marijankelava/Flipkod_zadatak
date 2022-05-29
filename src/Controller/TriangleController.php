<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Triangle;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TriangleRepository;

class TriangleController extends AbstractController
{
    private $em;
    private $triangleRepository;

    public function __construct(TriangleRepository $triangleRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->triangleRepository = $triangleRepository;
    }

    /**
     * @Route("/triangle/{a}/{b}/{c}", name="app_triangle", defaults={"a"=null, "b"=null, "c"=null}, methods={"GET"})
     */
    public function createTriangle(Request $request): JsonResponse
    {
        $parameters = $request->query->all();

        //dd($parameters);

        if (!isset($parameters['a'], $parameters['b'], $parameters['c'])) {
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

        $this->em->persist($triangle);
        $this->em->flush();

        return $this->json([
            'Saved new triangle with sides' => [$a, $b, $c]
        ]);
    }

    /**
     * @Route("/history/triangle/{id}", name="history_triangle", defaults={"id"=null}, methods={"GET"})
     */
    public function getTriangle($id) : JsonResponse
    {
        $triangle = $this->triangleRepository->getTriangles($id);

        //dd($triangle);

        return $this->json([
            'triangle' => $triangle
        ]);
    }   
}
