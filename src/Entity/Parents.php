<?php

namespace App\Entity;

use App\Repository\ParentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParentsRepository::class)
 */
class Parents
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
    private $nomFamille;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenomPere;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $nomFamilleMere;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $prenomMere;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $gsmPere;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $gsmMere;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $rue;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreationAt;



    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $totalPaiement;

    /**
     * @ORM\OneToMany(targetEntity=Eleve::class, mappedBy="parent")
     */
    private $eleves;

    /**
     * @ORM\OneToMany(targetEntity=Paiement::class, mappedBy="parent")
     */
    private $paiements;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->paiements = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFamille(): ?string
    {
        return $this->nomFamille;
    }

    public function setNomFamille(string $nomFamille): self
    {
        $this->nomFamille = $nomFamille;

        return $this;
    }

    public function getPrenomPere(): ?string
    {
        return $this->prenomPere;
    }

    public function setPrenomPere(string $prenomPere): self
    {
        $this->prenomPere = $prenomPere;

        return $this;
    }

    public function getNomFamilleMere(): ?string
    {
        return $this->nomFamilleMere;
    }

    public function setNomFamilleMere(string $nomFamilleMere): self
    {
        $this->nomFamilleMere = $nomFamilleMere;

        return $this;
    }

    public function getNomMere(): ?string
    {
        return $this->nomMere;
    }

    public function setNomMere(string $nomMere): self
    {
        $this->nomMere = $nomMere;

        return $this;
    }


    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getGsmPere(): ?string
    {
        return $this->gsmPere;
    }

    public function setGsmPere(string $gsmPere): self
    {
        $this->gsmPere = $gsmPere;

        return $this;
    }

    public function getGsmMere(): ?string
    {
        return $this->gsmMere;
    }

    public function setGsmMere(string $gsmMere): self
    {
        $this->gsmMere = $gsmMere;

        return $this;
    }

    public function getPrenomMere(): ?string
    {
        return $this->prenomMere;
    }

    public function setPrenomMere(string $prenomMere): self
    {
        $this->prenomMere = $prenomMere;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getDateCreationAt(): ?\DateTimeInterface
    {
        return $this->dateCreationAt;
    }

    public function setDateCreationAt(\DateTimeInterface $dateCreationAt): self
    {
        $this->dateCreationAt = $dateCreationAt;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTotalPaiement(): ?int
    {
        return $this->totalPaiement;
    }

    public function setTotalPaiement(?int $totalPaiement): self
    {
        $this->totalPaiement = $totalPaiement;

        return $this;
    }

    /**
     * @return Collection|Eleve[]
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves[] = $elefe;
            $elefe->setParent($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getParent() === $this) {
                $elefe->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Paiement[]
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements[] = $paiement;
            $paiement->setParent($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getParent() === $this) {
                $paiement->setParent(null);
            }
        }

        return $this;
    }
}
