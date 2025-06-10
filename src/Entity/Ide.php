<?php

namespace App\Entity;

use App\Repository\IdeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IdeRepository::class)]
class Ide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Langage>
     */
    #[ORM\ManyToMany(targetEntity: Langage::class, inversedBy: 'ides')]
    private Collection $langage;

    #[ORM\Column(length: 2047)]
    private ?string $visuel = null;

    #[ORM\Column(length: 16)]
    private ?string $couleur = null;

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

    public function getVisuel(): ?string
    {
        return $this->visuel;
    }

    public function setVisuel(string $visuel): static
    {
        $this->visuel = $visuel;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }
}
