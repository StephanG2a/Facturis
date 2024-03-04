<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 8; $i++) {
            $category = new Category();
            $category->setName($faker->word);

            $manager->persist($category);
            // This reference can be used to set categories in ServiceFixtures
            $this->addReference(Category::class . '_' . $i, $category);
        }

        $manager->flush();
    }
}
