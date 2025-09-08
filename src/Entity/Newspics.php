<?php

namespace App\Entity;

use App\Repository\NewspicsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewspicsRepository::class)]
class Newspics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $pics = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPics(): ?string
    {
        return $this->pics;
    }

    public function setPics(string $pics): static
    {
        $this->pics = $pics;

        return $this;
    }
}
