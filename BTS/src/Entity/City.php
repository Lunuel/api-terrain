<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     * @Assert\NotBlank(message="Le champ ville est vide")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sector", inversedBy="cities")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    protected $sector;


    /**
     * @ORM\Column(type="integer")
     */
    private $codePostal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bex", inversedBy="cities")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $bex;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Prestataire", inversedBy="cities")
     */
    protected $prestataires;

    private $label;

    public function __construct()
    {
        $this->prestataires = new ArrayCollection();
        $this->label = null;
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSector(): ?Sector
    {
        return $this->sector;
    }

    public function setSector(?Sector $sector): self
    {
        $this->sector = $sector;

        return $this;
    }


    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getBex(): ?Bex
    {
        return $this->bex;
    }

    public function setBex(?Bex $bex): self
    {
        $this->bex = $bex;

        return $this;
    }

    /**
     * @return Collection|Prestataire[]
     */
    public function getPrestataires(): Collection
    {
        return $this->prestataires;
    }

    public function addPrestataire(Prestataire $prestataire): self
    {
        if (!$this->prestataires->contains($prestataire)) {
            $this->prestataires[] = $prestataire;
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): self
    {
        if ($this->prestataires->contains($prestataire)) {
            $this->prestataires->removeElement($prestataire);
        }

        return $this;
    }

    public function getLabel(): ?String
    {
        $label = $this->name.'~'.$this->codePostal;
        return $label;
    }

    public function setlabel(?String $label): self
    {
        $this->label = $label;

        return $this;
    }
}
