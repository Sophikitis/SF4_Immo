<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i <100; $i++){
            $property = new Property();
            $property->setTitle($faker->words(3,true))
                ->setDescription($faker->sentences(3, true))
                ->setPrice($faker->numberBetween(50000, 1000000))
                ->setFloor($faker->numberBetween(0,10))
                ->setCity($faker->city)
                ->setSurface($faker->numberBetween(10, 300))
                ->setHeat($faker->numberBetween(0, count(Property::HEAT)-1))
                ->setAddress($faker->address)
                ->setPostalCode($faker->postcode)
                ->setBedroom($faker->numberBetween(1,10))
                ->setRooms($faker->numberBetween(1,10));

            $manager->persist($property);
        }
        $manager->flush();
    }
}
