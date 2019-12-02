<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Ecole;
use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\Niveau;
use App\Entity\Stage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class Admin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        $ecole = new Ecole();

        $ecole->setNom("Université centrale")
            ->setDescription($faker->sentence);
        $manager->persist($ecole);
        for ($i = 1; $i < 10; $i++) {
            $etud = new Etudiant();

            $etud->setCin($faker->numberBetween(10000000, 99999999))
                ->setNom($faker->name)
                ->setPrenom($faker->lastName)
                ->setAdresse($faker->address)
                ->setEmail($faker->email)
                ->setImage($faker->imageUrl())
                ->setAge($faker->numberBetween(15, 29))
                ->setEcole($ecole);

            $manager->persist($etud);

        }
        for ($i = 1; $i < 10; $i++) {
            $ens = new Enseignant();

            $ens->setCin($faker->numberBetween(10000000, 99999999))
                ->setNom($faker->name)
                ->setPrenom($faker->lastName)
                ->setAdresse($faker->address)
                ->setEmail($faker->email)
                ->setImage($faker->imageUrl())
                ->setSpecialite($faker->jobTitle)
                ->setEcole($ecole)
                ->setCv($faker->sentence);

            $manager->persist($ens);

        }
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i < 10; $i++) {
            $fiel = new Filiere();

            $fiel->setNom($faker->sentence)
                ->setEcole($ecole);

            $manager->persist($fiel);

        }


        for ($i = 1; $i < 10; $i++) {
            $st = new Stage();
            $st->setDescription($faker->sentence)
                ->setSujet($faker->sentence);
            $manager->persist($st);

        }
        for ($i = 1; $i < 3; $i++) {
            $niv = new Niveau();
            $niv->setNom($faker->sentence);
            $manager->persist($niv);

            for ($k = 1; $k < 10; $k++) {
                $class = new Classe();
                $class->setNom("Ing_Inf $k ")
                    ->setNiveau($niv);
                $manager->persist($class);

                for ($h = 1; $h < mt_rand(4, 6); $h++) {
                    $etud = new Etudiant();
                    $etud->setCin($faker->numberBetween(10000000, 99999999))
                        ->setNom($faker->name)
                        ->setPrenom($faker->lastName)
                        ->setAdresse($faker->address)
                        ->setEmail($faker->email)
                        ->setImage($faker->imageUrl())
                        ->setAge($faker->numberBetween(15, 29))
                        ->setEcole($ecole)
                        ->setClasse($class);
                    $manager->persist($etud);

                }
                $manager->persist($class);
            }
            $manager->persist($niv);
        }

        $manager->flush();
    }
}
