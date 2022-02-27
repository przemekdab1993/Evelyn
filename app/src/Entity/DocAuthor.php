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
     * @ORM\ManyToOne(targetEntity=Doc::class, inversedBy="yes")
     */
    private $Doc;

    /**
     * @ORM\ManyToOne(targetEntity=Tag::class)
     */
    private $Tag;

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
        return $this->Doc;
    }

    public function setDoc(?Doc $Doc): self
    {
        $this->Doc = $Doc;

        return $this;
    }

    public function getTag(): ?Tag
    {
        return $this->Tag;
    }

    public function setTag(?Tag $Tag): self
    {
        $this->Tag = $Tag;

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
