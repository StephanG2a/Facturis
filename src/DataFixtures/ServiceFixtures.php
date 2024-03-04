<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ServiceFixtures extends Fixture implements DependentFixtureInterface
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

        for ($i = 0; $i < 10; $i++) {
            $service = new Service();
            $service->setName($faker->word);
            $service->setPrice($faker->randomFloat(2, 10, 1000));
            $service->setDuration($faker->randomDigitNotNull . ' hours');
            // Example for setting the category, adjust according to your Category fixtures
            // $service->setUsers($this->getReference(User::class . '_' . rand(0, 10)));
            $service->setUsers($this->getReference('user-0'));
            $service->setCategory($this->getReference(Category::class . '_' . rand(0, 7)));

            $manager->persist($service);
        }

        $manager->flush();
    }
}
