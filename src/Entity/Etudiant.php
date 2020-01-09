<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $Sexe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $BirthDate;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Status;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $Lv2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Note;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Arrangement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EtablissementOrigine", inversedBy="etudiants")
     */
    private $etablissement_origine;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EnseignementComp", inversedBy="etudiants")
     */
    private $enseignement_comp;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CourOption", mappedBy="etudiant")
     */
    private $courOptions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Specialisation", mappedBy="etudiant")
     */
    private $specialisations;

    public function __construct()
    {
        $this->courOptions = new ArrayCollection();
        $this->specialisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(string $Sexe): self
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(?\DateTimeInterface $BirthDate): self
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getLv2(): ?string
    {
        return $this->Lv2;
    }

    public function setLv2(?string $Lv2): self
    {
        $this->Lv2 = $Lv2;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(?string $Note): self
    {
        $this->Note = $Note;

        return $this;
    }

    public function getArrangement(): ?string
    {
        return $this->Arrangement;
    }

    public function setArrangement(?string $Arrangement): self
    {
        $this->Arrangement = $Arrangement;

        return $this;
    }

    public function getEtablissementOrigine(): ?EtablissementOrigine
    {
        return $this->etablissement_origine;
    }

    public function setEtablissementOrigine(?EtablissementOrigine $etablissement_origine): self
    {
        $this->etablissement_origine = $etablissement_origine;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getEnseignementComp(): ?EnseignementComp
    {
        return $this->enseignement_comp;
    }

    public function setEnseignementComp(?EnseignementComp $enseignement_comp): self
    {
        $this->enseignement_comp = $enseignement_comp;

        return $this;
    }

    /**
     * @return Collection|CourOption[]
     */
    public function getCourOptions(): Collection
    {
        return $this->courOptions;
    }

    public function addCourOption(CourOption $courOption): self
    {
        if (!$this->courOptions->contains($courOption)) {
            $this->courOptions[] = $courOption;
            $courOption->addEtudiant($this);
        }

        return $this;
    }

    public function removeCourOption(CourOption $courOption): self
    {
        if ($this->courOptions->contains($courOption)) {
            $this->courOptions->removeElement($courOption);
            $courOption->removeEtudiant($this);
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
            $specialisation->addEtudiant($this);
        }

        return $this;
    }

    public function removeSpecialisation(Specialisation $specialisation): self
    {
        if ($this->specialisations->contains($specialisation)) {
            $this->specialisations->removeElement($specialisation);
            $specialisation->removeEtudiant($this);
        }

        return $this;
    }
}
