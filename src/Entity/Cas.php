<?php

namespace App\Entity;

use App\Repository\CasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CasRepository::class)
 */
class Cas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebutCasAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarques;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="cas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $histoireMaladie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\OneToMany(targetEntity=Visite::class, mappedBy="cas", orphanRemoval=true)
     */
    private $visites;

    public function __construct()
    {
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $this->visites = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getIntitule();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebutCasAt(): ?\DateTimeInterface
    {
        return $this->dateDebutCasAt;
    }

    public function setDateDebutCasAt(?\DateTimeInterface $dateDebutCasAt): self
    {
        $this->dateDebutCasAt = $dateDebutCasAt;

        return $this;
    }

    public function getRemarques(): ?string
    {
        return $this->remarques;
    }

    public function setRemarques(?string $remarques): self
    {
        $this->remarques = $remarques;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getHistoireMaladie(): ?string
    {
        return $this->histoireMaladie;
    }

    public function setHistoireMaladie(?string $histoireMaladie): self
    {
        $this->histoireMaladie = $histoireMaladie;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * @return Collection<int, Visite>
     */
    public function getVisites(): Collection
    {
        return $this->visites;
    }

    public function addVisite(Visite $visite): self
    {
        if (!$this->visites->contains($visite)) {
            $this->visites[] = $visite;
            $visite->setCas($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visites->removeElement($visite)) {
            // set the owning side to null (unless already changed)
            if ($visite->getCas() === $this) {
                $visite->setCas(null);
            }
        }

        return $this;
    }
}
