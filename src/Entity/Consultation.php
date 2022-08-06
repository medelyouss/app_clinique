<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsultationRepository::class)
 */
class Consultation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateConsultationAt;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="consultations")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="consultations")
     */
    private $medecin;

    /**
     * @ORM\Column(type="text")
     */
    private $plaintes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateConsultationAt(): ?\DateTimeInterface
    {
        return $this->dateConsultationAt;
    }

    public function setDateConsultationAt(\DateTimeInterface $dateConsultationAt): self
    {
        $this->dateConsultationAt = $dateConsultationAt;

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

    public function getMedecin(): ?User
    {
        return $this->medecin;
    }

    public function setMedecin(?User $medecin): self
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getPlaintes(): ?string
    {
        return $this->plaintes;
    }

    public function setPlaintes(string $plaintes): self
    {
        $this->plaintes = $plaintes;

        return $this;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }
}
