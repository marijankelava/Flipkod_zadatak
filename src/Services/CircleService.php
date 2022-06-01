<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CircleRepository;
use App\Entity\Circle;

final class CircleService
{
    private $em;
    private $circleRepository;
    private $circleService;

    public function __construct(
        CircleRepository $circleRepository, 
        EntityManagerInterface $em
        )
    {
        $this->em = $em;
        $this->circleRepository = $circleRepository;
    }

    public function create(array $parameters) : Circle
    {
        $radius = $parameters['radius'];

        $circle = new Circle($radius);
        $circle->setType(Circle::class);

        $this->em->persist($circle);
        $this->em->flush();

        return $circle;
    }

    public function show($id)
    {
        $circle = $this->circleRepository->getCircles($id);

        return $circle;
    }
}