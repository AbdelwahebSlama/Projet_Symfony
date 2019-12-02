<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauRepository")
 */
class Niveau
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
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Filiere", mappedBy="Niveau")
     */
    private $Filiere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Paiement", inversedBy="Niveau")
     */
    private $Paiement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Classe", mappedBy="Niveau")
     */
    private $Classe;

    public function __construct()
    {
        $this->Filiere = new ArrayCollection();
        $this->Classe = new ArrayCollection();
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
            $filiere->addNiveau($this);
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): self
    {
        if ($this->Filiere->contains($filiere)) {
            $this->Filiere->removeElement($filiere);
            $filiere->removeNiveau($this);
        }

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->Paiement;
    }

    public function setPaiement(?Paiement $Paiement): self
    {
        $this->Paiement = $Paiement;

        return $this;
    }

    /**
     * @return Collection|Classe[]
     */
    public function getClasse(): Collection
    {
        return $this->Classe;
    }

    public function addClasse(Classe $classe): self
    {
        if (!$this->Classe->contains($classe)) {
            $this->Classe[] = $classe;
            $classe->setNiveau($this);
        }

        return $this;
    }

    public function removeClasse(Classe $classe): self
    {
        if ($this->Classe->contains($classe)) {
            $this->Classe->removeElement($classe);
            // set the owning side to null (unless already changed)
            if ($classe->getNiveau() === $this) {
                $classe->setNiveau(null);
            }
        }

        return $this;
    }
}
