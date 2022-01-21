<?php

namespace App\Entity;

use App\Repository\DocRatingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocRatingRepository::class)
 */
class DocRating
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Doc::class, inversedBy="docRating", cascade={"persist", "remove"})
     */
    private $docId;

    /**
     * @ORM\Column(type="integer", options={"default":0})
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

    public function getDocId(): ?Doc
    {
        return $this->docId;
    }

    public function setDocId(?Doc $docId): self
    {
        $this->docId = $docId;

        return $this;
    }

    public function getGood(): ?int
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

    public function getBad(): ?int
    {
        return $this->bad;
    }

    public function setBad(int $bad): self
    {
        $this->bad = $bad;

        return $this;
    }
}
