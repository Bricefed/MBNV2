<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
     * @ORM\OneToMany(targetEntity=Meuble::class, mappedBy="categorie")
     */
    private $meuble;

    public function __construct()
    {
        $this->meuble = new ArrayCollection();
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
     * @return Collection|Meuble[]
     */
    public function getMeuble(): Collection
    {
        return $this->meuble;
    }

    public function addMeuble(Meuble $meuble): self
    {
        if (!$this->meuble->contains($meuble)) {
            $this->meuble[] = $meuble;
            $meuble->setCategorie($this);
        }

        return $this;
    }

    public function removeMeuble(Meuble $meuble): self
    {
        if ($this->meuble->contains($meuble)) {
            $this->meuble->removeElement($meuble);
            // set the owning side to null (unless already changed)
            if ($meuble->getCategorie() === $this) {
                $meuble->setCategorie(null);
            }
        }

        return $this;
    }
}
