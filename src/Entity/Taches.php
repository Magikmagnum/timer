<?php

namespace App\Entity;

use App\Entity\TimekeepTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TachesRepository;

#[ORM\Entity(repositoryClass: TachesRepository::class)]
class Taches
{
    use TimekeepTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $echeanceAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEcheanceAt(): ?\DateTimeImmutable
    {
        return $this->echeanceAt;
    }

    public function setEcheanceAt(?\DateTimeImmutable $echeanceAt): static
    {
        $this->echeanceAt = $echeanceAt;

        return $this;
    }
}