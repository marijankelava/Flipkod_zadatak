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
use App\Services\TriangleService;

class TriangleController extends AbstractController
{
    private $em;
    private $triangleRepository;
    private $triangleService;

    public function __construct(
        TriangleRepository $triangleRepository, 
        EntityManagerInterface $em, 
        TriangleService $triangleService
        )
    {
        $this->em = $em;
        $this->triangleRepository = $triangleRepository;
        $this->triangleService = $triangleService;
    }

    /**
     * @Route("/triangle/{a}/{b}/{c}", name="app_triangle", defaults={"a"=null, "b"=null, "c"=null}, methods={"GET"})
     */
    public function create(Request $request): JsonResponse
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

        $triangle = new Triangle($a, $b, $c);

        $triangle->setType(Triangle::class);
        $circumference = $triangle->circumference();
        $area = $triangle->area();

        $this->em->persist($triangle);
        $this->em->flush();

        return $this->json([
            'Saved new triangle with sides' => [$a, $b, $c],
            'circumference' => $circumference,
            'area' => $area
        ]);
    }

    /**
     * @Route("/history/triangle/{id}", name="history_triangle", defaults={"id"=null}, methods={"GET"})
     */
    public function show(int $id) : JsonResponse
    {
        $triangle = $this->triangleRepository->getTriangles($id);

        $a = $triangle[0]['a'];
        $b = $triangle[0]['b'];
        $c = $triangle[0]['c'];
        $type = $triangle[0]['type'];

        $triangle = new Triangle($a, $b, $c);
        $circumference = $triangle->circumference();
        $area = $triangle->area();

        return $this->json([
            'type' => $type,
            'id' => $id,
            'circumference' => $circumference,
            'area' => $area
        ]);
    }   
}
