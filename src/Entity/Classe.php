<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $AnneeScolaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Diplome", inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diplome;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etudiant", mappedBy="classe")
     */
    private $etudiants;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Specialisation", mappedBy="classe")
     */
    private $specialisations;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
        $this->specialisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAnneeScolaire(): ?\DateTimeInterface
    {
        return $this->AnneeScolaire;
    }

    public function setAnneeScolaire(\DateTimeInterface $AnneeScolaire): self
    {
        $this->AnneeScolaire = $AnneeScolaire;

        return $this;
    }

    public function getDiplome(): ?Diplome
    {
        return $this->diplome;
    }

    public function setDiplome(?Diplome $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setClasse($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->contains($etudiant)) {
            $this->etudiants->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getClasse() === $this) {
                $etudiant->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Specialisation[]
     */
    public function getSpecialisations(): Collection
    {
        return $this->specialisations;
    }

    public function addSpecialisation(Specialisation $specialisation): self
    {
        if (!$this->specialisations->contains($specialisation)) {
            $this->specialisations[] = $specialisation;
            $specialisation->addClasse($this);
        }

        return $this;
    }

    public function removeSpecialisation(Specialisation $specialisation): self
    {
        if ($this->specialisations->contains($specialisation)) {
            $this->specialisations->removeElement($specialisation);
            $specialisation->removeClasse($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
