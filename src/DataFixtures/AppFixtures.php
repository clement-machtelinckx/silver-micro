<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $restaurant = new Restaurant();
            $restaurant->setName('restaurant '.$i);
            $restaurant->setAdresse('adresse');
            $restaurant->setPhone('phone');
            $restaurant->setCuisine('cuisine');
            $manager->persist($restaurant );
        }

        $manager->flush();
    }
}
