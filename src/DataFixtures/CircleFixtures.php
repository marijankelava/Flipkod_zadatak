<?php

namespace App\DataFixtures;

use App\Entity\Circle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CircleFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 30; $i++) {
            ${'circle' . $i} = new Circle($i);
            ${'circle' . $i}->setRadius($i);
            ${'circle' . $i}->setType('circle');
            $manager->persist(${'circle' . $i});

            $manager->flush();
        }
    }
}