<?php

namespace App\Services;

use App\Entity\Triangle;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TriangleRepository;

final class TriangleService
{
    private $em;
    private TriangleRepository $triangleRepository;

    public function __construct(
        TriangleRepository $triangleRepository, 
        EntityManagerInterface $em
        )
    {
        $this->em = $em;
        $this->triangleRepository = $triangleRepository;
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

    public function show(?int $id)
    {
        $triangle = $this->triangleRepository->getTriangles($id);

        return $triangle;
    }
}