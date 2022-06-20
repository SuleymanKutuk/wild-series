<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
//Tout d'abord nous ajoutons la classe Factory de FakerPhp


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create('fr_FR');

        /**
         * L'objet $faker que tu récupère est l'outil qui va te permettre 
         * de te générer toutes les données que tu souhaites
         */

        for ($i = 0; $i < 100; $i++) {
            $episode = new Episode();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $episode->setNumber($faker->numberBetween(1, 11));
            $episode->setTitle($faker->sentence(3));
            $episode->setSynopsis($faker->paragraphs(3, true));

            $episode->setSeason($this->getReference('season_' . $faker->numberBetween(0, 5)));

            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}