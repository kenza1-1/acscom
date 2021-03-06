<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateursRepository")
 * @UniqueEntity(
 * fields= {"email"},
 * message ="l'email indiqué est déja utilisé !"
 * )
 * 
 */
class Utilisateurs implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * * *@Assert\Regex(
     * pattern = "/^[a-zA-Z0-9]+$/i",
     * htmlPattern = "^[a-zA-Z0-9]+$"
     * )
     * @ORM\Column(type="string", length=255)
     * * @Assert\Regex(
     *      "/^[a-z _-]{3,16}$/",
     *      message="Le nom peut comprendre des chiffres, des lettres, _ et - et doit faire entre 3 et 16 caractères."
     * )
     */
    private $nom;

    /**
     * *@Assert\Regex(
     * pattern = "/^[a-zA-Z0-9]+$/i",
     * htmlPattern = "^[a-zA-Z0-9]+$"
     * )
     * @ORM\Column(type="string", length=255)
<<<<<<< HEAD
     * 
=======
     * @Assert\Regex(
     *      "/^[a-z0-9_-]{3,16}$/",
     *      message="Le nom d'utilisateur peut comprendre des chiffres, des lettres, _ et - et doit faire entre 3 et 16 caractères."
     * )
>>>>>>> e790ceb230970f993f6de640f0511a862194b14c
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *      " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ",
     *      message="L'adresse mail doit prendre la forme suivante : exemple@exemple.com"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *      "/(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$/", 
     *      message="Exemple de mot de passe : Martinet1"
     * )
     */
    private $password;

    /**
    * @Assert\EqualTo(propertyPath="password",message="les deux mots de passe ne sont pas identiques !")
    */
    public $confirm_password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commandes", mappedBy="utilisateur")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UtilisateurAdresse", mappedBy="utilisateur")
     */
    private $utilisateurAdresses;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $activation_token;

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
    public function eraseCredentials(){}

    public function getSalt(){}

    public function getRoles(){
        return ['ROLE_USER'];
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }

}
