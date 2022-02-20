<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use App\Repository\DocRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
/**
 * @ORM\Entity(repositoryClass=DocRepository::class)
 */
class Doc
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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $lead;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $uppdatedDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToOne(targetEntity=DocRating::class, mappedBy="doc", cascade={"persist", "remove"})
     */
    private $docRating;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="doc", fetch="EXTRA_LAZY")
     * @OrderBy({"createdAt" = "DESC"})
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLead(): ?string
    {
        return $this->lead;
    }

    public function setLead(?string $lead): self
    {
        $this->lead = $lead;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getUppdatedDate(): ?\DateTimeInterface
    {
        return $this->uppdatedDate;
    }

    public function setUppdatedDate(?\DateTimeInterface $uppdatedDate): self
    {
        $this->uppdatedDate = $uppdatedDate;

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

    public function getDocRating(): ?DocRating
    {
        return $this->docRating;
    }

    public function setDocRating(?DocRating $docRating): self
    {
        // unset the owning side of the relation if necessary
        if ($docRating === null && $this->docRating !== null) {
            $this->docRating->setDoc(null);
        }

        // set the owning side of the relation if necessary
        if ($docRating !== null && $docRating->getDoc() !== $this) {
            $docRating->setDoc($this);
        }

        $this->docRating = $docRating;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getApprovedComments(): Collection
    {

        return $this->comments->matching(CommentRepository::createApprovedCriteria());

//        return $this->comments->filter(function (Comment $comment) {
//                return $comment->isApprovedComment();
//        });
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setDoc($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getDoc() === $this) {
                $comment->setDoc(null);
            }
        }

        return $this;
    }
}
