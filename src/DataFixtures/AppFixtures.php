<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Camera;
use App\Entity\Memory;
use App\Entity\SizeScreen;
use App\Entity\State;
use App\Entity\Storage;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    const BRANDS = [
        "Appel", "Samsum", "Xiaomi ","Sony", "Huawei", "Nokia", "LG", "Motorola", "HTC", "Lenovo", "Asus", "BlackBerry", "Alcatel"];
    const STORAGES = ["16 Go de stockage"=>10, "32 Go de stockage"=>15, "64 Go de stockage"=>20, "128 Go de stockage"=>25];
    const MEMORIES = ["1 Go de Ram"=>10, "2 Go de Ram"=>20, "3 Go de Ram"=>25, "4 Go de Ram"=>30];
    const SIZECAMERAS = [ "6 MP"=>10,"8 MP"=>15,"10 MP"=>20,"12 MP"=>25,"14 MP"=>30];
    const STATES = ["Neuf"=>10, "Occasion"=>-10, "Reconditionné"=>-5,"bloqué"=>-30];
    const SCREENSIZES = ["5.5 pouces"=>10,"6 pouces"=>15,"6.25 pouces"=>20,"6.5 pouces"=>25,"7 pouces"=>30];
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

    foreach (self::MEMORIES as $key => $value) {
            $memory = new Memory();
            $memory->setNumberMemory($key);
            $memory->setPrice($value);
            $manager->persist($memory);
         }
        $manager->flush();

        foreach (self::STORAGES as $key => $value) {
            $storage = new Storage();
            $storage->setNumberStorage($key);
            $storage->setPrice($value);
            $manager->persist($storage);
        }
        $manager->flush();

        foreach (self::STATES as $key => $value) {
            $state = new State();
            $state->setnameState($key);
            $state->setPourcentage($value);
            $manager->persist($state);
        }
        $manager->flush();

        foreach (self::SIZECAMERAS as $key => $value) {
            $camera = new Camera();
            $camera->setNumberPixel($key);
            $camera->setPrice($value);
            $manager->persist($camera);
        }
        $manager->flush();

        foreach (self::SCREENSIZES as $key => $value) {
            $screen = new sizeScreen();
            $screen->setNumberSizeScreen($key);
            $screen->setPrice($value);
            $manager->persist($screen);
        }
        $manager->flush();

        foreach (self::BRANDS as $value) {
            $brand = new Brand();
            $brand->setNameBrand($value);

            $manager->persist($brand);
        }
        $manager->flush();
    }


}
