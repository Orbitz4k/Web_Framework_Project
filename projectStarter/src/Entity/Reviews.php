<?php

namespace App\Entity;

use App\Repository\ReviewsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewsRepository::class)]
class Reviews
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $Rating;

    #[ORM\Column(type: 'string', length: 255)]
    private $Review;

    #[ORM\Column(type: 'boolean')]
    private $Rekekekemend;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->Rating;
    }

    public function setRating(int $Rating): self
    {
        $this->Rating = $Rating;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->Review;
    }

    public function setReview(string $Review): self
    {
        $this->Review = $Review;

        return $this;
    }

    public function getRekekekemend(): ?bool
    {
        return $this->Rekekekemend;
    }

    public function setRekekekemend(bool $Rekekekemend): self
    {
        $this->Rekekekemend = $Rekekekemend;

        return $this;
    }
}
