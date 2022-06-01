<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Triangle;
use App\Services\TriangleService;
use App\Repository\TriangleRepository;

class TriangleController extends AbstractController
{
    private $triangleService;

    public function __construct(
        TriangleService $triangleService
        )
    {
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

        $triangle = $this->triangleService->create($parameters);
        $circumference = $triangle->getCircumference();
        $area = $triangle->getArea();
        $a = $parameters['a'];
        $b = $parameters['b'];
        $c = $parameters['c'];

        return $this->json([
            'Saved new triangle with sides' => [$a, $b, $c],
            'circumference' => $circumference,
            'area' => $area
        ]);
    }

    /**
     * @Route("/history/triangle/{id}", name="history_triangle", defaults={"id"=null}, methods={"GET"})
     */
    public function show($id) : JsonResponse
    {
        //$triangle = $this->triangleRepository->getTriangles($id);

        $triangles = $this->triangleService->show($id);

        dd($triangles);

        foreach($triangles as $triangle){
            $type = $triangle->getType();
            $a = $this->triangle->getA();
            $b = $this->triangle->getB();
            $c = $this->triangle->getC();
            $circumference = $triangle->getCircumference();
            $area = $triangle->getArea();
        }    

        return $this->json([
            'type' => $type,
            'id' => $id,
            'a' => $a,
            'b' => $b,
            'c' => $c,
            'circumference' => $circumference,
            'area' => $area
        ]);
    }   
}
