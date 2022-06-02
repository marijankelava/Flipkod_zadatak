<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\CircleService;

final class CircleController extends AbstractController
{
    private CircleService $circleService;

    public function __construct(
        CircleService $circleService
        )
    {
        $this->circleService = $circleService;
    }
    
    /**
     * @Route("/circle/{radius}", name="app_circle", defaults={"radius"=null}, methods={"GET"})
     */
    public function create(Request $request) : JsonResponse
    {
        $parameters = $request->query->all();
        $radiusParam = $parameters['radius'] ?? null;
        $error = [];

        if ($radiusParam === null || strlen($radiusParam) === 0) {
            $error = [
                'success' => false,
                'error' => 'Radius is required'
            ];
        }elseif(!is_numeric($radiusParam)){
            $error = [
                'success' => false,
                'error' => 'Radius is not formatted correctly'
            ];            
        }

        if (count($error)) {
            return $this->json($error);
        }
        
        $radius = (float) $radiusParam;
        $circle = $this->circleService->create($radius);
        $circumference = $circle->getCircumference();
        $area = $circle->getArea();

        return $this->json([
            'Saved new circle with radius value' => $radius,
            'circumference' => $circumference,
            'area' => $area
        ]);
    }

    /**
     * @Route("/history/circle/{id}", name="history_circle", defaults={"id"=null}, methods={"GET"})
     */
    public function show($id) : JsonResponse
    {

        $circles = $this->circleService->show($id);

        //dd($circles);

        foreach($circles as $circle){
            $radius = $circle->getRadius();
            $type = $circle->getType();
            $circumference = $circle->getCircumference();
            $area = $circle->getArea();

            $json[] = [
                'type' => $type,
                'radius' => $radius,
                'circumference' => $circumference,
                'area' => $area 
            ];
        }    
            return $this->json($json);
    }
}
