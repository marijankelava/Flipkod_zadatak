<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

final class CircleService
{
    public function circumference(float $radius) : float
    {
        return $circumference = pi() * 2 * $radius;
    }

    public function area(float $radius) : float
    {
        return $area = pow(2, $radius) * pi();
    }
}