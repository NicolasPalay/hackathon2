<?php

namespace App\Services;

use App\Entity\Device;

class PriceDevice
{

        public function calculate(Device $device): float {
            $memory = $device->getMemory();
            $storage = $device->getStorage();
            $sizeScreen = $device->getSizeScreen();
            $state = $device->getState();
            $camera = $device->getCamera();

            if ($memory === null || $storage === null || $sizeScreen === null || $state === null || $camera === null) {
                // Gérer le cas où l'une des propriétés associées est nulle
                return 0.0; // Ou une valeur par défaut appropriée
            }
        $memoryPrice = $device->getMemory()->getPrice();
        $storagePrice = $device->getStorage()->getPrice();
        $sizeScreenPrice = $device->getSizeScreen()->getPrice();
        $statePrice = $device->getState()->getPourcentage();
        $cameraPrice = $device->getCamera()->getPrice();
        $priceSimple = $memoryPrice+ $storagePrice + $sizeScreenPrice + $cameraPrice;
            $device->setPrice($priceSimple + ($priceSimple * $statePrice / 100));
        return $device->getPrice();

    }
}