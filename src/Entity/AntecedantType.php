<?php

namespace App\Entity;

use App\Repository\AntecedantTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AntecedantTypeRepository::class)
 */
class AntecedantType
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
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity=Antecedant::class, mappedBy="antecedantType")
     */
    private $antecedants;

    public function __construct()
    {
        $this->antecedants = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection<int, Antecedant>
     */
    public function getAntecedants(): Collection
    {
        return $this->antecedants;
    }

    public function addAntecedant(Antecedant $antecedant): self
    {
        if (!$this->antecedants->contains($antecedant)) {
            $this->antecedants[] = $antecedant;
            $antecedant->setAntecedantType($this);
        }

        return $this;
    }

    public function removeAntecedant(Antecedant $antecedant): self
    {
        if ($this->antecedants->removeElement($antecedant)) {
            // set the owning side to null (unless already changed)
            if ($antecedant->getAntecedantType() === $this) {
                $antecedant->setAntecedantType(null);
            }
        }

        return $this;
    }
}
