<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Restaurant;
use App\Entity\Reservation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // crée 20 utilisateurs fictifs
        for ($i = 0; $i < 20; $i++){
            $user = new User();
            $user->setEmail('test' . $i . '@gmail.com');
            $user->setPassword('password');
            $manager->persist($user); // persist l'utilisateur immédiatement après sa création
        }

        // crée 20 restaurant fictifs
        for ($i = 0; $i < 20; $i++) {
            $restaurant = new Restaurant();
            $restaurant->setName('restaurant '.$i);
            $restaurant->setAdresse('adresse');
            $restaurant->setPhone('phone');
            $restaurant->setCuisine('cuisine');
            $restaurant->setDescription('this is a général description of the restaurant and the cuisine it serves.\n It is a very nice place to eat and enjoy a good meal.');
            $manager->persist($restaurant );
        }
        $manager->flush();
        // crée 20 réservations fictives
        for ($i = 0; $i < 20; $i++) {
            $reservation = new Reservation();
            $reservation->setDateTime(new \DateTimeImmutable());
            $reservation->setNbOfGuests(rand(1, 9));

            // récupère un utilisateur aléatoire
            $users = $manager->getRepository(User::class)->findAll();
            if (count($users) > 0) {
                $randomIndex = rand(0, count($users) - 1);
                $reservation->setUser($users[$randomIndex]);
            }

            // récupère un restaurant aléatoire
            $restaurants = $manager->getRepository(Restaurant::class)->findAll();
            if (count($restaurants) > 0) {
                $randomIndex = rand(0, count($restaurants) - 1);
                $reservation->setRestaurant($restaurants[$randomIndex]);
            }

            $manager->persist($reservation);
        }
        $manager->flush();
    }

}

