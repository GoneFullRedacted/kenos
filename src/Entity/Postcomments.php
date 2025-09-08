<?php

namespace App\Entity;

use App\Repository\PostcommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostcommentsRepository::class)]
class Postcomments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'postscomments')]
    private ?Posts $posts = null;

    #[ORM\ManyToOne(inversedBy: 'postcomments')]
    private ?users $author_id = null;

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

    public function getPosts(): ?Posts
    {
        return $this->posts;
    }

    public function setPosts(?Posts $posts): static
    {
        $this->posts = $posts;

        return $this;
    }

    public function getAuthorId(): ?users
    {
        return $this->author_id;
    }

    public function setAuthorId(?users $author_id): static
    {
        $this->author_id = $author_id;

        return $this;
    }
}
