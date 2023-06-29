<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Camera;
use App\Entity\Device;
use App\Entity\Memory;
use App\Entity\SizeScreen;
use App\Entity\State;
use App\Entity\Storage;
use App\Entity\User;
use App\Repository\BrandRepository;
use App\Repository\CameraRepository;
use App\Repository\MemoryRepository;
use App\Repository\SizeScreenRepository;
use App\Repository\StateRepository;
use App\Repository\StorageRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function __construct(BrandRepository $brandRepository,MemoryRepository $memoryRepository,
                                CameraRepository $cameraRepository,
                                SizeScreenRepository $sizeScreenRepository,
                                StateRepository $stateRepository,
                                StorageRepository $storageRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->memoryRepository = $memoryRepository;
        $this->cameraRepository = $cameraRepository;
        $this->sizeScreenRepository = $sizeScreenRepository;
        $this->stateRepository = $stateRepository;
        $this->storageRepository = $storageRepository;
    }

    const PRICE = [
        94.5,99.75, 57.75,94.5,123.5, 49.5];
    const DEVICES = [
        "Apple 10", "S 10", "Redmi note 12","xperia 5 iv", "p30", "6.2 Dual Sim"];
    const BRANDS = [
        "Apple", "Samsung", "Xiaomi ","Sony", "Huawei", "Nokia"];
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

        foreach (self::DEVICES as $key => $value) {
            $device = new Device();

            $brandName = self::BRANDS[$key];
            $brand = $this->brandRepository->findOneBy(['nameBrand' => $brandName]);
            $device->setBrand($brand);

            $memoryKeys = array_keys(self::MEMORIES);
            $memoryKey = $memoryKeys[rand(0, count($memoryKeys) - 1)];
            $memory = $this->memoryRepository->findOneBy(['numberMemory' => $memoryKey]);
            $device->setMemory($memory);

            $storageKeys = array_keys(self::STORAGES);
            $storageKey = $storageKeys[rand(0, count($storageKeys) - 1)];
            $storage = $this->storageRepository->findOneBy(['numberStorage' => $storageKey]);
            $device->setStorage($storage);

            $sizeScreenKeys = array_keys(self::SCREENSIZES);
            $sizeScreenKey = $sizeScreenKeys[rand(0, count($sizeScreenKeys) - 1)];
            $sizeScreen = $this->sizeScreenRepository->findOneBy(['numberSizeScreen' => $sizeScreenKey]);
            $device->setSizeScreen($sizeScreen);

            $cameraKeys = array_keys(self::SIZECAMERAS);
            $cameraKey = $cameraKeys[rand(0, count($cameraKeys) - 1)];
            $camera = $this->cameraRepository->findOneBy(['numberPixel' => $cameraKey]);
            $device->setCamera($camera);

            $stateKeys = array_keys(self::STATES);
            $stateKey = $stateKeys[rand(0, count($stateKeys) - 1)];
            $state = $this->stateRepository->findOneBy(['nameState' => $stateKey]);
            $device->setState($state);

            $device->setName($value);
            $device->setImage($faker->imageUrl(640, 480, 'technics'));
            $device->setStock(rand(1, 6));
            $device->setPrice(self::PRICE[$key]);
            $manager->persist($device);
        }

        $manager->flush();
    }




}
