<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $user = new User();
        $user->setEmail($faker->email());
        $user->setRoles(['ROLE_UER']);
        $user->setPlainPassword('123456');
        $manager->persist($user);

        $manager->flush();


        $user = new User();
        $user->setEmail($faker->email());
        $user->setRoles(['ROLE_Admin']);
        $user->setPlainPassword('123456');
        $manager->persist($user);

        $manager->flush();
    }
}
