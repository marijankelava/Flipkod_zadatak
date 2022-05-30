<?php

namespace App\DataFixtures;

use App\Entity\Triangle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TriangleFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 30; $i++) {
            ${'triangle' . $i} = new Triangle($i, ($i + mt_rand(2, 5)), ($i + mt_rand(7, 12)));
            ${'triangle' . $i}->setType('triangle');
            $manager->persist(${'triangle' . $i});

            $manager->flush();
        }
    }
}