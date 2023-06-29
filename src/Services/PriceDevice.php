<?php

namespace App\Services;

use App\Entity\Device;

class PriceDevice
{
    public function calculate(Device $device): float {
        $memory = $device->getMemory()->getPrice();
        $storage = $device->getStorage()->getPrice();
        $sizeScreen = $device->getSizeScreen()->getPrice();
        $state = $device->getState()->getPourcentage();
        $camera = $device->getCamera()->getPrice();
        $price = $memory+ $storage + $sizeScreen + $camera;
        return $price;
    }
}