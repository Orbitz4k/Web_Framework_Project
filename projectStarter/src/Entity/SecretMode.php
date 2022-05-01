<?php

namespace App\Entity;

use App\Repository\SecretModeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecretModeRepository::class)]
class SecretMode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $Daredevil;

    #[ORM\Column(type: 'integer')]
    private $SuccessfulNights;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDaredevil(): ?bool
    {
        return $this->Daredevil;
    }

    public function setDaredevil(bool $Daredevil): self
    {
        $this->Daredevil = $Daredevil;

        return $this;
    }

    public function getSuccessfulNights(): ?int
    {
        return $this->SuccessfulNights;
    }

    public function setSuccessfulNights(int $SuccessfulNights): self
    {
        $this->SuccessfulNights = $SuccessfulNights;

        return $this;
    }
}
