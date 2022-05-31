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
    private $em;
    private $circleRepository;
    private $serializer;

    public function __construct(CircleRepository $circleRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->circleRepository = $circleRepository;
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

        $radius = $parameters['radius'];

        $circle = new Circle($radius);
        $circle->setType(Circle::class);
        $circumference = $circle->getCircumference();
        $area = $circle->getArea();

        $this->em->persist($circle);
        $this->em->flush();

        return $this->json([
            'Saved new circle with radius value' => $radius,
            'circumference' => $circumference,
            'area' => $area
        ]);
    }

    /**
     * @Route("/history/circle/{id}", name="history_circle", defaults={"id"=null}, methods={"GET"})
     */
    public function show(int $id) : JsonResponse
    {
        $circle = $this->circleRepository->getCircles($id);

        $radius = $circle[0]['radius'];
        $type = $circle[0]['type'];

        $circle = new Circle($radius);
        $circumference = $circle->getCircumference();
        $area = $circle->getArea();

        return $this->json([
            'type' => $type,
            'id' => $id,
            'circumference' => $circumference,
            'area' => $area
        ]);
    }
}
