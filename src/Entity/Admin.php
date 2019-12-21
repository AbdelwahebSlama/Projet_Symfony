<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="L'email est déjà utilisé"
 * )
 * @UniqueEntity(
 *     fields={"cin"},
 *     message="Le numéro de cin est déjà utilisé"
 * )
 */
class Admin implements UserInterface, \Serializable
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
    private $cin;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $post;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit contenir au moin 8 caracter")
     * @Assert\EqualTo(propertyPath="confirm_password", message="Vous n'avez pas tapé le mème mot de passe")
     */
    private $motpasse;

    /*
     * @Assert\EqualTo(propertyPath="motpasse", message="Vous n'avez pas tapé le mème mot de passe")
     */
    public $confirm_password;

    private $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getMotpasse(): ?string
    {
        return $this->motpasse;
    }

    public function setMotpasse(string $motpasse): self
    {
        $this->motpasse = $motpasse;

        return $this;
    }

    public function eraseCredentials()
    {
    }

//    public function getRoles()
//    {
//        return ['ROLE_USER'];
//        // TODO: Implement getRoles() method.
//    }

    public function getPassword()
    {
        return $this->motpasse;
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->nom;
        // TODO: Implement getUsername() method.
    }

    public function serialize()
    {
        return Serialize([
            $this->id,
            $this->nom,
            $this->prenom,
            $this->email,
            $this->adresse,
            $this->motpasse,
            $this->image,
            $this->post

        ]);
    }

    public function unserialize($string)
    {
        list(
            $this->id,
            $this->nom,
            $this->prenom,
            $this->email,
            $this->adresse,
            $this->motpasse,
            $this->image,
            $this->post

            ) = $this->unserialize($string, ['allowed_classes' => false]);

    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }



}
