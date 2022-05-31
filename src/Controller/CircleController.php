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
    public function createCircle(Request $request) : JsonResponse
    {
        $parameters = $request->query->all();

        if (!isset($parameters['radius'])) {
            echo "Please enter radius value";
            exit;
        }

        $radius = $parameters['radius'];

        $circle = new Circle($radius);
        $circle->setType('circle');
        $circumference = $circle->circumference();
        $area = $circle->area();

        $this->em->persist($circle);
        $this->em->flush();

        return $this->json([
            'Saved new circle with radius value' => $radius,
            'circumference' => $circumference,
            'area' => $area
        ]);

         /*$circle = new Circle();
        $circle->setRadius($radius);

        $this->em->persist($circle);
        $this->em->flush();

        $circumference = CircleService::circumference($radius);
        $area = CircleService::area($radius);

        return $this->json([
            'Saved new circle with radius value' => $radius,
            'circumference' => $circumference,
            'area' => $area
        ]);*/
    }

    /**
     * @Route("/history/circle/{id}", name="history_circle", defaults={"id"=null}, methods={"GET"})
     */
    public function getCircle(CircleService $radius, $id) : JsonResponse
    {
        $circle = $this->circleRepository->getCircles($id);

        $radius = $circle[0]['radius'];
        $type = $circle[0]['type'];

        $circle = new Circle($radius);
        $circumference = $circle->circumference();
        $area = $circle->area();

        return $this->json([
            'type' => $type,
            'id' => $id,
            'circumference' => $circumference,
            'area' => $area
        ]);

         /*$circumference = CircleService::circumference($radius);
        $area = CircleService::area($radius);

        return $this->json([
            'circle' => $circle,
            'circumference' => $circumference,
            'area' => $area
        ]);*/
    }
}
