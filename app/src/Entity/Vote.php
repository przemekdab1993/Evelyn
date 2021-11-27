<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 */
class Vote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity=VotePoint::class, mappedBy="voteId")
     */
    private $votePoints;

    public function __construct()
    {
        $this->votePoints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|VotePoint[]
     */
    public function getVotePoints(): Collection
    {
        return $this->votePoints;
    }

    public function addVotePoint(VotePoint $votePoint): self
    {
        if (!$this->votePoints->contains($votePoint)) {
            $this->votePoints[] = $votePoint;
            $votePoint->setVoteId($this);
        }

        return $this;
    }

    public function removeVotePoint(VotePoint $votePoint): self
    {
        if ($this->votePoints->removeElement($votePoint)) {
            // set the owning side to null (unless already changed)
            if ($votePoint->getVoteId() === $this) {
                $votePoint->setVoteId(null);
            }
        }

        return $this;
    }
}
