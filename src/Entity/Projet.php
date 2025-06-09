<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $nom = null;

    #[ORM\Column(length: 200)]
    private ?string $description = null;

    #[ORM\Column(length: 32)]
    private ?string $duree = null;

    #[ORM\Column(length: 32)]
    private ?string $equipe = null;

    /**
     * @var Collection<int, Langage>
     */
    #[ORM\ManyToMany(targetEntity: Langage::class, inversedBy: 'projets')]
    private Collection $langage;

    #[ORM\Column(length: 2047)]
    private ?string $descriptionLongue = null;

    #[ORM\Column]
    private ?bool $important = null;

    #[ORM\Column(length: 1023)]
    private ?string $visuel = null;

    #[ORM\Column(length: 1023, nullable: true)]
    private ?string $lienGithub = null;

    public function __construct()
    {
        $this->langage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getEquipe(): ?string
    {
        return $this->equipe;
    }

    public function setEquipe(string $equipe): static
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * @return Collection<int, Langage>
     */
    public function getLangage(): Collection
    {
        return $this->langage;
    }

    public function addLangage(Langage $langage): static
    {
        if (!$this->langage->contains($langage)) {
            $this->langage->add($langage);
        }

        return $this;
    }

    public function removeLangage(Langage $langage): static
    {
        $this->langage->removeElement($langage);

        return $this;
    }

    public function getDescriptionLongue(): ?string
    {
        return $this->descriptionLongue;
    }

    public function setDescriptionLongue(string $descriptionLongue): static
    {
        $this->descriptionLongue = $descriptionLongue;

        return $this;
    }

    public function isImportant(): ?bool
    {
        return $this->important;
    }

    public function setImportant(bool $important): static
    {
        $this->important = $important;

        return $this;
    }

    public function getVisuel(): ?string
    {
        return $this->visuel;
    }

    public function setVisuel(string $visuel): static
    {
        $this->visuel = $visuel;

        return $this;
    }

    public function getLienGithub(): ?string
    {
        return $this->lienGithub;
    }

    public function setLienGithub(?string $lienGithub): static
    {
        $this->lienGithub = $lienGithub;

        return $this;
    }
}
