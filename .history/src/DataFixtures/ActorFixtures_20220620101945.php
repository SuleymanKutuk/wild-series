<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 11; $i++) {

            $actor = new Actor();

            $actor->setName($faker->name());
        }
        // $manager->persist($product);

        $manager->flush();
    }
}