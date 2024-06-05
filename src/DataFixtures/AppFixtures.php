<?php

namespace App\DataFixtures;

use App\Entity\Recip;
use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $faker = \Faker\Factory::create();
    for ($i = 0; $i < 33; $i++) {
      $ingredient = new Ingredient();
      $recip = new Recip();
      $ingredient
        ->setName($faker->sentence(3))
        ->setSeasonality($faker->word);
      $recip
        ->setName($faker->sentence(3))
        ->setText($faker->paragraph(4))
        ->setDateofcreate($faker->dateTimeBetween('-1 week', '+1 month'))
        ->setImg($faker->paragraph(3));
      $manager->persist($ingredient);
      $manager->persist($recip);
    }
    $manager->flush();
  }
}
