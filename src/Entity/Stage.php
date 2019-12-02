<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 */
class Stage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sujet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="Stage")
     */
    private $Type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etudiant", mappedBy="Stage")
     */
    private $Etudiant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enseignant", inversedBy="Stage")
     */
    private $Enseignant;

    public function __construct()
    {
        $this->Etudiant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->Type;
    }

    public function setType(?Type $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiant(): Collection
    {
        return $this->Etudiant;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->Etudiant->contains($etudiant)) {
            $this->Etudiant[] = $etudiant;
            $etudiant->setStage($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->Etudiant->contains($etudiant)) {
            $this->Etudiant->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getStage() === $this) {
                $etudiant->setStage(null);
            }
        }

        return $this;
    }

    public function getEnseignant(): ?Enseignant
    {
        return $this->Enseignant;
    }

    public function setEnseignant(?Enseignant $Enseignant): self
    {
        $this->Enseignant = $Enseignant;

        return $this;
    }
}
