<?php

namespace App\Entity;

use App\Repository\LangageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangageRepository::class)]
class Langage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $nom = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $version = null;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\ManyToMany(targetEntity: Projet::class, mappedBy: 'langage')]
    private Collection $projets;

    /**
     * @var Collection<int, Ide>
     */
    #[ORM\ManyToMany(targetEntity: Ide::class, mappedBy: 'Langage')]
    private Collection $ides;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
        $this->ides = new ArrayCollection();
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

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): static
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->addLangage($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            $projet->removeLangage($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Ide>
     */
    public function getIdes(): Collection
    {
        return $this->ides;
    }

    public function addIde(Ide $ide): static
    {
        if (!$this->ides->contains($ide)) {
            $this->ides->add($ide);
            $ide->addLangage($this);
        }

        return $this;
    }

    public function removeIde(Ide $ide): static
    {
        if ($this->ides->removeElement($ide)) {
            $ide->removeLangage($this);
        }

        return $this;
    }
}
