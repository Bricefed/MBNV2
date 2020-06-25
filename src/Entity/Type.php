<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
     * @ORM\OneToOne(targetEntity=Avis::class, inversedBy="type", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $avis;

    /**
     * @ORM\OneToOne(targetEntity=Meuble::class, mappedBy="type", cascade={"persist", "remove"})
     */
    private $meuble;

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

    public function getAvis(): ?Avis
    {
        return $this->avis;
    }

    public function setAvis(Avis $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getMeuble(): ?Meuble
    {
        return $this->meuble;
    }

    public function setMeuble(Meuble $meuble): self
    {
        $this->meuble = $meuble;

        // set the owning side of the relation if necessary
        if ($meuble->getType() !== $this) {
            $meuble->setType($this);
        }

        return $this;
    }
}
