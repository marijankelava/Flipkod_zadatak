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

    public function create(float $a, float $b, float $c) : Triangle
    {
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