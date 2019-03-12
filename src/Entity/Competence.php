<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceRepository")
 */
class Competence
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Offre", inversedBy="competenceId")
     */
    private $offreId;

    public function __construct()
    {
        $this->offreId = new ArrayCollection();
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
     * @return Collection|Offre[]
     */
    public function getOffreId(): Collection
    {
        return $this->offreId;
    }

    public function addOffreId(Offre $offreId): self
    {
        if (!$this->offreId->contains($offreId)) {
            $this->offreId[] = $offreId;
        }

        return $this;
    }

    public function removeOffreId(Offre $offreId): self
    {
        if ($this->offreId->contains($offreId)) {
            $this->offreId->removeElement($offreId);
        }

        return $this;
    }
}
