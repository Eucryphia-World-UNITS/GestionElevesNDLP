<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourOptionRepository")
 */
class CourOption
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Etudiant", inversedBy="courOptions")
     */
    private $etudiant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Diplome", inversedBy="courOptions")
     */
    private $diplome;

    public function __construct()
    {
        $this->etudiant = new ArrayCollection();
        $this->diplome = new ArrayCollection();
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

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiant(): Collection
    {
        return $this->etudiant;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiant->contains($etudiant)) {
            $this->etudiant[] = $etudiant;
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiant->contains($etudiant)) {
            $this->etudiant->removeElement($etudiant);
        }

        return $this;
    }

    /**
     * @return Collection|Diplome[]
     */
    public function getDiplome(): Collection
    {
        return $this->diplome;
    }

    public function addDiplome(Diplome $diplome): self
    {
        if (!$this->diplome->contains($diplome)) {
            $this->diplome[] = $diplome;
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): self
    {
        if ($this->diplome->contains($diplome)) {
            $this->diplome->removeElement($diplome);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

}
