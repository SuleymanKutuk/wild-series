<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*$category = new Category();
        $category->setName('Horreur');
        $manager->persist($category);
        $manager->flush();*/
    }
}