<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct()
    {
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $client = new Client();
            $client->setCompanyName($faker->company);
            $client->setFirstName($faker->firstName);
            $client->setLastName($faker->lastName);
            $client->setEmail($faker->email);
            $client->setPhone($faker->phoneNumber);
            $client->setAddress($faker->address);
            // Assuming you're relating clients to a single user
            // You might want to adjust this depending on your actual User fixtures
            // $client->setUsers($this->getReference(User::class . '_' . rand(0, 10)));
            $client->setUsers($this->getReference('user-0'));

            $manager->persist($client);
        }

        $manager->flush();
    }
}
