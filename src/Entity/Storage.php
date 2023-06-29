<?php

namespace App\Entity;

use App\Repository\StorageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StorageRepository::class)]
class Storage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $numberStorage = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\OneToMany(mappedBy: 'storage', targetEntity: Device::class)]
    private Collection $devices;

    public function __construct()
    {
        $this->devices = new ArrayCollection();
    }
public function __toString(): string
    {
        return $this->numberStorage;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberStorage(): ?string
    {
        return $this->numberStorage;
    }

    public function setNumberStorage(string $numberStorage): static
    {
        $this->numberStorage = $numberStorage;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Device>
     */
    public function getDevices(): Collection
    {
        return $this->devices;
    }

    public function addDevice(Device $device): static
    {
        if (!$this->devices->contains($device)) {
            $this->devices->add($device);
            $device->setStorage($this);
        }

        return $this;
    }

    public function removeDevice(Device $device): static
    {
        if ($this->devices->removeElement($device)) {
            // set the owning side to null (unless already changed)
            if ($device->getStorage() === $this) {
                $device->setStorage(null);
            }
        }

        return $this;
    }
}
