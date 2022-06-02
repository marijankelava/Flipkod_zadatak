<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CircleRepository;
use App\Entity\Circle;

final class CircleService
{
    private EntityManagerInterface $em;
    private CircleRepository $circleRepository;

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

    public function show(?int $id)
    {
        $data = $this->circleRepository->getCircles($id);

        return $data;
    }
}