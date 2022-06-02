<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Circle;
use App\Repository\CircleRepository;
use App\Services\CircleService;

class CircleController extends AbstractController
{
    private $circleService;

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

        if (!isset($parameters['radius'])) {
            echo "Please enter radius value";
            exit;
        }

        $circle = $this->circleService->create($parameters);
        $circumference = $circle->getCircumference();
        $area = $circle->getArea();
        $radius = $parameters['radius'];

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
