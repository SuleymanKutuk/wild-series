<?php

namespace App\DataFixtures;

use Faker\Factory;
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

            $actor->setProgram($this->getReference('program_' . rand(0, 3)));

            $manager->persist($actor);
        }


        $manager->flush();
    }
}