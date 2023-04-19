<?php

namespace App\Entity;

use App\Repository\DocAuthorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocAuthorRepository::class)
 */
class DocAuthor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Doc::class, inversedBy="docAuthors")
     */
    private $doc;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class)
     */
    private $author;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $addAt;

    public function __construct()
    {
        $this->addAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoc(): ?Doc
    {
        return $this->doc;
    }

    public function setDoc(?Doc $doc): self
    {
        $this->doc = $doc;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAddAt(): ?\DateTimeImmutable
    {
        return $this->addAt;
    }

    public function setAddAt(\DateTimeImmutable $addAt): self
    {
        $this->addAt = $addAt;

        return $this;
    }
}
