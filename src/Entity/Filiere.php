<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FiliereRepository")
 */
class Filiere
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Ecole", inversedBy="Filiere")
     */
    private $Ecole;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Niveau", inversedBy="Filiere")
     */
    private $Niveau;

    public function __construct()
    {
        $this->Niveau = new ArrayCollection();
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

    public function getEcole(): ?Ecole
    {
        return $this->Ecole;
    }

    public function setEcole(?Ecole $Ecole): self
    {
        $this->Ecole = $Ecole;

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveau(): Collection
    {
        return $this->Niveau;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->Niveau->contains($niveau)) {
            $this->Niveau[] = $niveau;
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->Niveau->contains($niveau)) {
            $this->Niveau->removeElement($niveau);
        }

        return $this;
    }
}
