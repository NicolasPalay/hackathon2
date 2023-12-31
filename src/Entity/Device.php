<?php

namespace App\Entity;

use App\Repository\DeviceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeviceRepository::class)]
class Device
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\ManyToOne(inversedBy: 'devices')]
    private ?Memory $memory = null;

    #[ORM\ManyToOne(inversedBy: 'devices')]
    private ?Storage $storage = null;

    #[ORM\ManyToOne(inversedBy: 'devices')]
    private ?SizeScreen $sizeScreen = null;

    #[ORM\ManyToOne(inversedBy: 'devices')]
    private ?Camera $camera = null;

    #[ORM\ManyToOne(inversedBy: 'devices')]
    private ?State $state = null;

    #[ORM\ManyToOne(inversedBy: 'devices')]
    private ?Brand $brand = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getMemory(): ?Memory
    {
        return $this->memory;
    }

    public function setMemory(?Memory $memory): static
    {
        $this->memory = $memory;

        return $this;
    }

    public function getStorage(): ?Storage
    {
        return $this->storage;
    }

    public function setStorage(?Storage $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function getSizeScreen(): ?SizeScreen
    {
        return $this->sizeScreen;
    }

    public function setSizeScreen(?SizeScreen $sizeScreen): static
    {
        $this->sizeScreen = $sizeScreen;

        return $this;
    }

    public function getCamera(): ?Camera
    {
        return $this->camera;
    }

    public function setCamera(?Camera $camera): static
    {
        $this->camera = $camera;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        if ($price !== null) {
            $this->price = $price;
        }

        return $this;
    }

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
        $this->setPrice($priceSimple + ($priceSimple * $statePrice / 100));
        return $priceSimple + ($priceSimple * $statePrice / 100);

    }
}
