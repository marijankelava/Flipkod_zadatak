<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
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
    public static function circumference(float $radius) : float
    {
        return $circumference = pi() * 2 * $radius;
    }

    public static function area(float $radius) : float
    {
        return $area = pow(2, $radius) * pi();
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
}