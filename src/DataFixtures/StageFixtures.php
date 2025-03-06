<?php

namespace App\DataFixtures;

use App\Entity\Stage;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StageFixtures extends Fixture
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // créer 10 stages
        for ($i = 0; $i < 10; $i++) {
            $stage = new Stage();
            $stage->setLibelle($this->faker->company);
            $stage->setDate($this->faker->dateTime);
            $stage->setNombreParticipants($this->faker->randomNumber(2));
            $manager->persist($stage);
        }
        $manager->flush();
    }
}
