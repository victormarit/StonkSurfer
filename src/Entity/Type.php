<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
    private $nomType;

    /**
     * @ORM\OneToMany(targetEntity=Consommable::class, mappedBy="idType")
     */
    private $consommables;

    public function __construct()
    {
        $this->consommables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomType(): ?string
    {
        return $this->nomType;
    }

    public function setNomType(string $nomType): self
    {
        $this->nomType = $nomType;

        return $this;
    }

    /**
     * @return Collection|Consommable[]
     */
    public function getConsommables(): Collection
    {
        return $this->consommables;
    }

    public function addConsommable(Consommable $consommable): self
    {
        if (!$this->consommables->contains($consommable)) {
            $this->consommables[] = $consommable;
            $consommable->setIdType($this);
        }

        return $this;
    }

    public function removeConsommable(Consommable $consommable): self
    {
        if ($this->consommables->removeElement($consommable)) {
            // set the owning side to null (unless already changed)
            if ($consommable->getIdType() === $this) {
                $consommable->setIdType(null);
            }
        }

        return $this;
    }
}
