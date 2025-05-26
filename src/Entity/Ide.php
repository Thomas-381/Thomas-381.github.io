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
    private Collection $Langage;

    public function __construct()
    {
        $this->Langage = new ArrayCollection();
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
        return $this->Langage;
    }

    public function addLangage(Langage $langage): static
    {
        if (!$this->Langage->contains($langage)) {
            $this->Langage->add($langage);
        }

        return $this;
    }

    public function removeLangage(Langage $langage): static
    {
        $this->Langage->removeElement($langage);

        return $this;
    }
}
