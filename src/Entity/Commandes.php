<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandesRepository")
 */
class Commandes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valider = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $reference = 0;

    /**
     * @ORM\Column(type="array")
     */
    private $produits = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\utilisateurs", inversedBy="commandes")
     */
    private $utilisateur;

    public function __construct()
    {
       

        $this->date = new \DateTime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValider(): ?bool
    {
        return $this->valider;
    }

    public function setValider(bool $valider): self
    {
        $this->valider = $valider;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getProduits(): ?array
    {
        return $this->produits;
    }

    public function setProduits(array $produits): self
    {
        $this->produits = $produits;

        return $this;
    }

    public function getUtilisateur(): ?utilisateurs
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateurs $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
