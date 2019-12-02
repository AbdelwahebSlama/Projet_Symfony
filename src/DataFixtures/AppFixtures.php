<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $admin = new \App\Entity\Admin();
        $admin->setCin($faker->numberBetween(10000000, 99999999))
            ->setNom($faker->name)
            ->setPrenom($faker->lastName)
            ->setAdresse($faker->address)
            ->setEmail($faker->email)
            ->setImage($faker->imageUrl())
            ->setPost("Administrateur");
        $manager->persist($admin);
        $manager->flush();
    }
}
