<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Circle;

class CircleController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    /**
     * @Route("/circle/{radius}", name="app_circle", defaults={"radius"=null}, methods={"GET"})
     */
    public function createData(Request $request) : JsonResponse
    {
        $parameters = $request->query->all();

        $radius = null;

        if (isset($parameters['radius'])) {
            $radius = $parameters['radius'];
        } 
        
        $circle = new Circle();
        $circle->setRadius($radius);

        //dd($circle);

        $this->em->persist($circle);

        $this->em->flush();

        return $this->json([
            'Saved new circle with radius value' => $radius
        ]);
    }
}
