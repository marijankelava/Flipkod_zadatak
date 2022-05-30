<?php

namespace App\Entity;

Interface TriangleInterface
{
    public function circumference() : float;

    public function area() : float;
}