<?php

namespace App\Entity;

use App\Repository\LocationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationsRepository::class)]
class Locations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $locname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocname(): ?string
    {
        return $this->locname;
    }

    public function setLocname(string $locname): static
    {
        $this->locname = $locname;

        return $this;
    }
}
