<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'likes')]
    private Collection $users;

    /**
     * @var Collection<int, categories>
     */
    #[ORM\ManyToMany(targetEntity: categories::class, inversedBy: 'posts')]
    private Collection $posts_has_categories;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->posts_has_categories = new ArrayCollection();
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

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addLike($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeLike($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, categories>
     */
    public function getPostsHasCategories(): Collection
    {
        return $this->posts_has_categories;
    }

    public function addPostsHasCategory(categories $postsHasCategory): static
    {
        if (!$this->posts_has_categories->contains($postsHasCategory)) {
            $this->posts_has_categories->add($postsHasCategory);
        }

        return $this;
    }

    public function removePostsHasCategory(categories $postsHasCategory): static
    {
        $this->posts_has_categories->removeElement($postsHasCategory);

        return $this;
    }
}
