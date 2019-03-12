<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContratRepository")
 */
class Contrat
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
     * @ORM\OneToMany(targetEntity="App\Entity\Offre", mappedBy="contratId")
     */
    private $contratId;

    public function __construct()
    {
        $this->contratId = new ArrayCollection();
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
    public function getContratId(): Collection
    {
        return $this->contratId;
    }

    public function addContratId(Offre $contratId): self
    {
        if (!$this->contratId->contains($contratId)) {
            $this->contratId[] = $contratId;
            $contratId->setContratId($this);
        }

        return $this;
    }

    public function removeContratId(Offre $contratId): self
    {
        if ($this->contratId->contains($contratId)) {
            $this->contratId->removeElement($contratId);
            // set the owning side to null (unless already changed)
            if ($contratId->getContratId() === $this) {
                $contratId->setContratId(null);
            }
        }

        return $this;
    }
}
