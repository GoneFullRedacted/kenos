<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\ManyToOne(inversedBy: 'news')]
    private ?Users $users = null;

    #[ORM\Column(length: 150)]
    private ?string $title = null;

    #[ORM\Column(length: 150)]
    private ?string $slug = null;

    /**
     * @var Collection<int, Newspics>
     */
    #[ORM\OneToMany(targetEntity: Newspics::class, mappedBy: 'news')]
    private Collection $newspics;

    public function __construct()
    {
        $this->newspics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Newspics>
     */
    public function getNewspics(): Collection
    {
        return $this->newspics;
    }

    public function addNewspic(Newspics $newspic): static
    {
        if (!$this->newspics->contains($newspic)) {
            $this->newspics->add($newspic);
            $newspic->setNews($this);
        }

        return $this;
    }

    public function removeNewspic(Newspics $newspic): static
    {
        if ($this->newspics->removeElement($newspic)) {
            // set the owning side to null (unless already changed)
            if ($newspic->getNews() === $this) {
                $newspic->setNews(null);
            }
        }

        return $this;
    }
}
