<?php

namespace App\DataFixtures;

use App\Entity\Ranges;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RangeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $range = new Ranges(1244470000000000000, 1244470000000000000);
        $manager->persist($range);

        $manager->flush();
    }
}
