<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformationsRepository")
 */
class Informations
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
    private $Attaque;

    /**
     * @ORM\Column(type="integer")
     */
    private $Defense;

    /**
     * @ORM\Column(type="float")
     */
    private $Difficulté;

    /**
     * @ORM\Column(type="integer")
     */
    private $Magique;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Champ", mappedBy="informations")
     */
    private $champs;

    public function __construct()
    {
        $this->champs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttaque(): ?int
    {
        return $this->Attaque;
    }

    public function setAttaque(int $Attaque): self
    {
        $this->Attaque = $Attaque;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->Defense;
    }

    public function setDefense(int $Defense): self
    {
        $this->Defense = $Defense;

        return $this;
    }

    public function getDifficulté(): ?float
    {
        return $this->Difficulté;
    }

    public function setDifficulté(float $Difficulté): self
    {
        $this->Difficulté = $Difficulté;

        return $this;
    }

    public function getMagique(): ?int
    {
        return $this->Magique;
    }

    public function setMagique(int $Magique): self
    {
        $this->Magique = $Magique;

        return $this;
    }

    /**
     * @return Collection|Champ[]
     */
    public function getChamps(): Collection
    {
        return $this->champs;
    }

    public function addChamp(Champ $champ): self
    {
        if (!$this->champs->contains($champ)) {
            $this->champs[] = $champ;
            $champ->addInformation($this);
        }

        return $this;
    }

    public function removeChamp(Champ $champ): self
    {
        if ($this->champs->contains($champ)) {
            $this->champs->removeElement($champ);
            $champ->removeInformation($this);
        }

        return $this;
    }
}
