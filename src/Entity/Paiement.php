<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaiementRepository")
 */
class Paiement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Niveau", mappedBy="Paiement")
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

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

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
            $niveau->setPaiement($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->Niveau->contains($niveau)) {
            $this->Niveau->removeElement($niveau);
            // set the owning side to null (unless already changed)
            if ($niveau->getPaiement() === $this) {
                $niveau->setPaiement(null);
            }
        }

        return $this;
    }
}
