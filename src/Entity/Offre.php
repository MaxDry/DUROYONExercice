<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OffreRepository")
 */
class Offre
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
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contrat", inversedBy="contratId")
     */
    private $contratId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Job", inversedBy="offreId")
     */
    private $jobId;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Competence", mappedBy="offreId")
     */
    private $competenceId;

    public function __construct()
    {
        $this->competenceId = new ArrayCollection();
        $this->candidatureId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContratId(): ?Contrat
    {
        return $this->contratId;
    }

    public function setContratId(?Contrat $contratId): self
    {
        $this->contratId = $contratId;

        return $this;
    }

    public function getJobId(): ?Job
    {
        return $this->jobId;
    }

    public function setJobId(?Job $jobId): self
    {
        $this->jobId = $jobId;

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetenceId(): Collection
    {
        return $this->competenceId;
    }

    public function addCompetenceId(Competence $competenceId): self
    {
        if (!$this->competenceId->contains($competenceId)) {
            $this->competenceId[] = $competenceId;
            $competenceId->addOffreId($this);
        }

        return $this;
    }

    public function removeCompetenceId(Competence $competenceId): self
    {
        if ($this->competenceId->contains($competenceId)) {
            $this->competenceId->removeElement($competenceId);
            $competenceId->removeOffreId($this);
        }

        return $this;
    }
}
