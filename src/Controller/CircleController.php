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
use App\Services\TriangleService;

class CircleController extends AbstractController
{
    private $em;
    private $circleRepository;

    public function __construct(CircleRepository $circleRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->circleRepository = $circleRepository;
    }
    
    /**
     * @Route("/circle/{radius}", name="app_circle", defaults={"radius"=null}, methods={"GET"})
     */
    public function createCircle(Request $request) : JsonResponse
    {
        $parameters = $request->query->all();

        if (!isset($parameters['radius'])) {
            echo "Please enter radius value";
            exit;
        }

        $radius = $parameters['radius'];
        
        $circle = new Circle();
        $circle->setRadius($radius);

        $this->em->persist($circle);
        $this->em->flush();

        return $this->json([
            'Saved new circle with radius value' => $radius
        ]);
    }

    /**
     * @Route("/history/circle/{id}", name="history_circle", defaults={"id"=null}, methods={"GET"})
     */
    public function getCircle($id) : JsonResponse
    {
        $circle = $this->circleRepository->getCircles($id);

        return $this->json([
            'circle' => $circle
        ]);
    }   
}
