<?php

namespace App\Entity;

Interface CircleInterface
{
    public function circumference() : float;

    public function area() : float;
}