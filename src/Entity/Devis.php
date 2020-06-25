<?php

namespace App\Entity;

use App\Repository\DevisRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DevisRepository::class)
 */
class Devis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Ne peux pas être vide")
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2, max=25, minMessage="Au minimum 2 caractères", maxMessage="Au maximum 25 caractères")
     */
    private $prenom;

    /**
     * @Assert\NotBlank(message="Ne peux pas être vide")
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2, max=25, minMessage="Au minimum 2 caractères", maxMessage="Au maximum 25 caractères")
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="Sélectioner un département")
     * @ORM\Column(type="string", length=255)
     */
    private $departement;

    /**
     * @Assert\NotBlank(message="Entrez un email valide")
     * @Assert\Email(message = "email non valide")
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Assert\NotBlank(message="Sélectioner un meuble")
     * @ORM\Column(type="string", length=255)
     */
    private $meubles;

    /**
     * @Assert\NotBlank(message="Entrez une valeur (chiffre entier)")
     * @ORM\Column(type="integer")
     * @Assert\Range(min=10, max=350, notInRangeMessage="Vous devez mesurer entre {{ min }}cm et {{ max }}cm",)
     */
    private $longueur;

    /**
     * @Assert\NotBlank(message="Entrez une valeur (nombre entier)")
     * @ORM\Column(type="integer")
     * @Assert\Range(min=10, max=250, notInRangeMessage="Vous devez mesurer entre {{ min }}cm et {{ max }}cm",)
     */
    private $largeur;

    /**
     * @Assert\NotBlank(message="Sélectioner un type de bois")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeBois;

    /**
     * @Assert\NotBlank(message="Sélectioner un budget")
     * @ORM\Column(type="string", length=255)
     */
    private $budget;

    /**
     * @Assert\NotBlank(message="Laisser un message")
     * @ORM\Column(type="text")
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

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

    public function getMeubles(): ?string
    {
        return $this->meubles;
    }

    public function setMeubles(string $meubles): self
    {
        $this->meubles = $meubles;

        return $this;
    }

    public function getLongueur(): ?int
    {
        return $this->longueur;
    }

    public function setLongueur(int $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->largeur;
    }

    public function setLargeur(int $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getTypeBois(): ?string
    {
        return $this->typeBois;
    }

    public function setTypeBois(?string $typeBois): self
    {
        $this->typeBois = $typeBois;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
