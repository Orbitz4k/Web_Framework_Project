<?php

namespace App\Entity;

use App\Repository\SolicitorsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SolicitorsRepository::class)]
class Solicitors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Courts;

    #[ORM\Column(type: 'string', length: 255)]
    private $Clients;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourts(): ?string
    {
        return $this->Courts;
    }

    public function setCourts(string $Courts): self
    {
        $this->Courts = $Courts;

        return $this;
    }

    public function getClients(): ?string
    {
        return $this->Clients;
    }

    public function setClients(string $Clients): self
    {
        $this->Clients = $Clients;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }
}
