<?php

namespace App\Entity;

use App\Repository\NiveauScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauScolaireRepository::class)
 */
class NiveauScolaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomNiveauScolaire;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="niveauScolaire")
     */
    private $classes;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomNiveauScolaire(): ?string
    {
        return $this->nomNiveauScolaire;
    }

    public function setNomNiveauScolaire(string $nomNiveauScolaire): self
    {
        $this->nomNiveauScolaire = $nomNiveauScolaire;

        return $this;
    }

    /**
     * @return Collection|Classe[]
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->setNiveauScolaire($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getNiveauScolaire() === $this) {
                $class->setNiveauScolaire(null);
            }
        }

        return $this;
    }
}
