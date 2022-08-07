<?php

namespace App\Entity;

use App\Repository\VisiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisiteRepository::class)
 */
class Visite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motif;

    /**
     * @ORM\ManyToOne(targetEntity=Cas::class, inversedBy="visites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cas;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $interrogatoire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $examen;

    /**
     * @ORM\Column(type="text")
     */
    private $conclusion;

    /**
     * @ORM\Column(type="date")
     */
    private $dateVisiteAt;

    public function __construct()
    {
        date_default_timezone_set("Africa/Dar_es_Salaam");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(?string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getCas(): ?Cas
    {
        return $this->cas;
    }

    public function setCas(?Cas $cas): self
    {
        $this->cas = $cas;

        return $this;
    }

    public function getInterrogatoire(): ?string
    {
        return $this->interrogatoire;
    }

    public function setInterrogatoire(?string $interrogatoire): self
    {
        $this->interrogatoire = $interrogatoire;

        return $this;
    }

    public function getExamen(): ?string
    {
        return $this->examen;
    }

    public function setExamen(?string $examen): self
    {
        $this->examen = $examen;

        return $this;
    }

    public function getConclusion(): ?string
    {
        return $this->conclusion;
    }

    public function setConclusion(string $conclusion): self
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    public function getDateVisiteAt(): ?\DateTimeInterface
    {
        return $this->dateVisiteAt;
    }

    public function setDateVisiteAt(\DateTimeInterface $dateVisiteAt): self
    {
        $this->dateVisiteAt = $dateVisiteAt;

        return $this;
    }
}
