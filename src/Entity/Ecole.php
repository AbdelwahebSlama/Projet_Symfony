<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EcoleRepository")
 */
class Ecole
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enseignant", mappedBy="Ecole")
     */
    private $Enseignant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etudiant", mappedBy="Ecole")
     */
    private $Etudiant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Filiere", mappedBy="Ecole")
     */
    private $Filiere;

    public function __construct()
    {
        $this->Enseignant = new ArrayCollection();
        $this->Etudiant = new ArrayCollection();
        $this->Filiere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Enseignant[]
     */
    public function getEnseignant(): Collection
    {
        return $this->Enseignant;
    }

    public function addEnseignant(Enseignant $enseignant): self
    {
        if (!$this->Enseignant->contains($enseignant)) {
            $this->Enseignant[] = $enseignant;
            $enseignant->setEcole($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->Enseignant->contains($enseignant)) {
            $this->Enseignant->removeElement($enseignant);
            // set the owning side to null (unless already changed)
            if ($enseignant->getEcole() === $this) {
                $enseignant->setEcole(null);
            }
        }

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
            $etudiant->setEcole($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->Etudiant->contains($etudiant)) {
            $this->Etudiant->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getEcole() === $this) {
                $etudiant->setEcole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Filiere[]
     */
    public function getFiliere(): Collection
    {
        return $this->Filiere;
    }

    public function addFiliere(Filiere $filiere): self
    {
        if (!$this->Filiere->contains($filiere)) {
            $this->Filiere[] = $filiere;
            $filiere->setEcole($this);
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): self
    {
        if ($this->Filiere->contains($filiere)) {
            $this->Filiere->removeElement($filiere);
            // set the owning side to null (unless already changed)
            if ($filiere->getEcole() === $this) {
                $filiere->setEcole(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
        // TODO: Implement __toString() method.
    }
}
