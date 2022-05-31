<?php

namespace App\Services;

use App\Entity\Triangle;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TriangleRepository;
use Symfony\Component\HttpFoundation\Request;

final class TriangleService
{
    private $em;
    private $triangleRepository;

    public function __construct(
        TriangleRepository $triangleRepository, 
        EntityManagerInterface $em
        )
    {
        $this->em = $em;
        $this->triangleRepository = $triangleRepository;
    }

    public static function circumference(float $radius) : float
    {
        return $circumference = pi() * 2 * $radius;
    }

    public static function area(float $radius) : float
    {
        return $area = pow(2, $radius) * pi();
    }

    public function create(array $parameters) : Triangle
    {
        $a = $parameters['a'];
        $b = $parameters['b'];
        $c = $parameters['c'];

        $triangle = new Triangle($a, $b, $c);

        $triangle->setType(Triangle::class);

        $this->em->persist($triangle);
        $this->em->flush();

        return $triangle;
    }
}