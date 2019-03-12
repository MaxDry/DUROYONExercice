<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
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
     * @ORM\OneToMany(targetEntity="App\Entity\Offre", mappedBy="jobId")
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
            $offreId->setJobId($this);
        }

        return $this;
    }

    public function removeOffreId(Offre $offreId): self
    {
        if ($this->offreId->contains($offreId)) {
            $this->offreId->removeElement($offreId);
            // set the owning side to null (unless already changed)
            if ($offreId->getJobId() === $this) {
                $offreId->setJobId(null);
            }
        }

        return $this;
    }
}
