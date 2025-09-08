<?php

namespace App\Entity;

use App\Repository\PostspicsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostspicsRepository::class)]
class Postspics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $postspics = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostspics(): ?string
    {
        return $this->postspics;
    }

    public function setPostspics(string $postspics): static
    {
        $this->postspics = $postspics;

        return $this;
    }
}
