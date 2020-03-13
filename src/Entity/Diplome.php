<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiplomeRepository")
 */
class Diplome
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
     * @ORM\Column(type="boolean")
     */
    private $lv2_obligatoire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeFormation", inversedBy="diplomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_formation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Classe", mappedBy="diplome", orphanRemoval=true)
     */
    private $classes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EnseignementComp", mappedBy="diplome", orphanRemoval=true)
     */
    private $enseignementComps;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CourOption", mappedBy="diplome")
     */
    private $courOptions;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->enseignementComps = new ArrayCollection();
        $this->courOptions = new ArrayCollection();
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

    public function getLv2Obligatoire(): ?bool
    {
        return $this->lv2_obligatoire;
    }

    public function setLv2Obligatoire(bool $lv2_obligatoire): self
    {
        $this->lv2_obligatoire = $lv2_obligatoire;

        return $this;
    }

    public function getTypeFormation(): ?TypeFormation
    {
        return $this->type_formation;
    }

    public function setTypeFormation(?TypeFormation $type_formation): self
    {
        $this->type_formation = $type_formation;

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
            $class->setDiplome($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->contains($class)) {
            $this->classes->removeElement($class);
            // set the owning side to null (unless already changed)
            if ($class->getDiplome() === $this) {
                $class->setDiplome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EnseignementComp[]
     */
    public function getEnseignementComps(): Collection
    {
        return $this->enseignementComps;
    }

    public function addEnseignementComp(EnseignementComp $enseignementComp): self
    {
        if (!$this->enseignementComps->contains($enseignementComp)) {
            $this->enseignementComps[] = $enseignementComp;
            $enseignementComp->setDiplome($this);
        }

        return $this;
    }

    public function removeEnseignementComp(EnseignementComp $enseignementComp): self
    {
        if ($this->enseignementComps->contains($enseignementComp)) {
            $this->enseignementComps->removeElement($enseignementComp);
            // set the owning side to null (unless already changed)
            if ($enseignementComp->getDiplome() === $this) {
                $enseignementComp->setDiplome(null);
            }
        }

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
            $courOption->addDiplome($this);
        }

        return $this;
    }

    public function removeCourOption(CourOption $courOption): self
    {
        if ($this->courOptions->contains($courOption)) {
            $this->courOptions->removeElement($courOption);
            $courOption->removeDiplome($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
