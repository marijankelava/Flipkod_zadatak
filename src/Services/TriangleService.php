<?php

namespace App\Services;

use App\Entity\Triangle;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TriangleRepository;

final class TriangleService
{
    private EntityManagerInterface $em;
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
        $data = $this->triangleRepository->getTriangles($id);

        return $data;
    }
}