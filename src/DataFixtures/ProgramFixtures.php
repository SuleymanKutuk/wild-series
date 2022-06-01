<?php

namespace App\DataFixtures;


use App\Entity\Program;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;




class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void

    {
        $faker = factory::create('fr_FR');

        for ($i = 0; $i < 40; $i++) {
            $program = new Program();
            $program->setTitle($faker->sentence(5));
            $program->setSynopsis($faker->paragraphs(3, true));
            $program->setPoster('');
            $program->setCategory($this->getReference('category_' . CategoryFixtures::CATEGORIES[rand(0, count(CategoryFixtures::CATEGORIES) - 1)]));
            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}