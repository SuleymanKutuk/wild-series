<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 11; $i++) {

            $actor = new Actor();

            $actor->setName($faker->numberBetween(1, 11));
        }
        // $manager->persist($product);

        $manager->flush();
    }
}