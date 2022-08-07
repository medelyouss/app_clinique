<?php

namespace App\Entity;

use App\Repository\AntecedantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AntecedantRepository::class)
 */
class Antecedant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\ManyToOne(targetEntity=AntecedantType::class, inversedBy="antecedants")
     */
    private $antecedantType;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getAntecedantType(): ?AntecedantType
    {
        return $this->antecedantType;
    }

    public function setAntecedantType(?AntecedantType $antecedantType): self
    {
        $this->antecedantType = $antecedantType;

        return $this;
    }

}
