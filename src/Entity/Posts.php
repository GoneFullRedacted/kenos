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

    #[ORM\ManyToOne(inversedBy: 'posts')]
    private ?Users $user = null;

    /**
     * @var Collection<int, postspics>
     */
    #[ORM\OneToMany(targetEntity: postspics::class, mappedBy: 'posts')]
    private Collection $postspics;

    /**
     * @var Collection<int, postcomments>
     */
    #[ORM\OneToMany(targetEntity: postcomments::class, mappedBy: 'posts')]
    private Collection $postscomments;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->posts_has_categories = new ArrayCollection();
        $this->postspics = new ArrayCollection();
        $this->postscomments = new ArrayCollection();
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

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, postspics>
     */
    public function getPostspics(): Collection
    {
        return $this->postspics;
    }

    public function addPostspic(postspics $postspic): static
    {
        if (!$this->postspics->contains($postspic)) {
            $this->postspics->add($postspic);
            $postspic->setPosts($this);
        }

        return $this;
    }

    public function removePostspic(postspics $postspic): static
    {
        if ($this->postspics->removeElement($postspic)) {
            // set the owning side to null (unless already changed)
            if ($postspic->getPosts() === $this) {
                $postspic->setPosts(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, postcomments>
     */
    public function getPostscomments(): Collection
    {
        return $this->postscomments;
    }

    public function addPostscomment(postcomments $postscomment): static
    {
        if (!$this->postscomments->contains($postscomment)) {
            $this->postscomments->add($postscomment);
            $postscomment->setPosts($this);
        }

        return $this;
    }

    public function removePostscomment(postcomments $postscomment): static
    {
        if ($this->postscomments->removeElement($postscomment)) {
            // set the owning side to null (unless already changed)
            if ($postscomment->getPosts() === $this) {
                $postscomment->setPosts(null);
            }
        }

        return $this;
    }
}
