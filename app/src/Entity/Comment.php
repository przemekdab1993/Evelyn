<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    use TimestampableEntity;

    public const STATUS_NEEDS_APPROVAL = 'need_approval';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_SPAM = 'spam';


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $userName;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=Doc::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doc;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $status = self::STATUS_NEEDS_APPROVAL;

    /**
     * @ORM\Column(type="integer")
     */
    private $vote = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getDoc(): ?Doc
    {
        return $this->doc;
    }

    public function getDocTitleText(): string
    {
        if (!$this->getDoc()) {
            return '';
        }

        return (string) $this->getDoc()->getTitle();
    }

    public function setDoc(?Doc $doc): self
    {
        $this->doc = $doc;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        if(!in_array($status, [self::STATUS_NEEDS_APPROVAL, self::STATUS_APPROVED, self::STATUS_SPAM])) {
            throw new \InvalidArgumentException(sprintf('Invalidy status "%s"', $status));
        }
        $this->status = $status;

        return $this;
    }

    public function isApprovedComment(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function getVote(): ?int
    {
        return $this->vote;
    }

    public function setVote(int $vote): self
    {
        $this->vote = $vote;

        return $this;
    }
    public function upVote(): self
    {
        $this->vote++;

        return $this;
    }
}
