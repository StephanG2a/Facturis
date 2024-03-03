<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    public function __construct()
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; ++$i) {
            $client = (new Client())
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setEmail($faker->email())
                ->setAddress($faker->address());
            $manager->persist($client);
        }
        $manager->flush();
    }
}
