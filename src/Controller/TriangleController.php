<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\TriangleService;

final class TriangleController extends AbstractController
{
    private TriangleService $triangleService;

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
    public function show(?int $id) : JsonResponse
    {
        $triangles = $this->triangleService->show($id);

        //dd($triangles);

        foreach($triangles as $triangle){
            $type = $triangle->getType();
            $a = $triangle->getA();
            $b = $triangle->getB();
            $c = $triangle->getC();
            $circumference = $triangle->getCircumference();
            $area = $triangle->getArea();

            $json[] = [
                'type' => $type,
                'a' => $a,
                'b' => $b,
                'c' => $c,
                'circumference' => $circumference,
                'area' => $area 
            ];
        }    

        return $this->json($json);
    }   
}
