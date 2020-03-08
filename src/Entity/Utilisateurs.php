<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateursRepository")
 */
class Utilisateurs
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motdepasse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commandes", mappedBy="utilisateur")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UtilisateurAdresse", mappedBy="utilisateur")
     */
    private $utilisateurAdresses;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->utilisateurAdresses = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    /**
     * @return Collection|Commandes[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commandes $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getUtilisateur() === $this) {
                $commande->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UtilisateurAdresse[]
     */
    public function getUtilisateurAdresses(): Collection
    {
        return $this->utilisateurAdresses;
    }

    public function addUtilisateurAdress(UtilisateurAdresse $utilisateurAdress): self
    {
        if (!$this->utilisateurAdresses->contains($utilisateurAdress)) {
            $this->utilisateurAdresses[] = $utilisateurAdress;
            $utilisateurAdress->setUtilisateur($this);
        }

        return $this;
    }

    public function removeUtilisateurAdress(UtilisateurAdresse $utilisateurAdress): self
    {
        if ($this->utilisateurAdresses->contains($utilisateurAdress)) {
            $this->utilisateurAdresses->removeElement($utilisateurAdress);
            // set the owning side to null (unless already changed)
            if ($utilisateurAdress->getUtilisateur() === $this) {
                $utilisateurAdress->setUtilisateur(null);
            }
        }

        return $this;
    }
}
