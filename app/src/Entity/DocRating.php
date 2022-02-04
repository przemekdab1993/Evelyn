<?php

namespace App\Entity;

use App\Repository\DocRatingRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableDocument;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=DocRatingRepository::class)
 */
class DocRating
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Doc::class, inversedBy="docRating", cascade={"persist", "remove"})
     */
    private $doc;

    /**
     * @ORM\Column(type="integer")
     */
    private $good = 0;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $bad = 0;

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

    public function getGood(): int
    {
        return $this->good;
    }

    public function getGoodString($typeRating): string
    {
        if ($typeRating == 'good') {
            $prefix = '+';
            return sprintf('%s%d',$prefix, abs($this->getGood()));

        } else if ($typeRating == 'bad') {
            $prefix = '-';
            return sprintf('%s%d',$prefix, abs($this->getBad()));
        }
    }

    public function setGood(int $good): self
    {
        $this->good = $good;

        return $this;
    }

    public function getBad(): int
    {
        return $this->bad;
    }

    public function setBad(int $bad): self
    {
        $this->bad = $bad;

        return $this;
    }

    public function upVoteGood() {
        $this->good = ++$this->good;

        return $this;
    }
    public function upVoteBad() {
        $this->bad++;

        return $this;
    }
}
