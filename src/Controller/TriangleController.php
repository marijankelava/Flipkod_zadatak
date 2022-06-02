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

        $a = $parameters['a'] ?? null;
        $b = $parameters['b'] ?? null;
        $c = $parameters['c'] ?? null;

        $error = [];

        if ($a === null || $b === null || $c === null) {
            $error = [
                'success' => false,
                'error' => 'Please enter triangle side values'
            ];
        }elseif(!is_numeric($parameters['a']) || !is_numeric($parameters['b']) || !is_numeric($parameters['c'])){
            $error = [
                'success' => false,
                'error' => 'Please enter correct values'
            ];            
        }

        if (count($error)) {
            return $this->json($error);
        }

        $triangle = $this->triangleService->create($a, $b, $c);
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
