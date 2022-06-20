<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {


        for ($i = 0; $i < 10; $i++) {

            $Actor = new Actor();
        }
        // $manager->persist($product);

        $manager->flush();
    }
}