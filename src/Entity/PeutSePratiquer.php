<?php

namespace App\Entity;

use App\Repository\PeutSePratiquerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeutSePratiquerRepository::class)
 */
class PeutSePratiquer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Spot::class, inversedBy="peutSePratiquers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSpot;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class, inversedBy="peutSePratiquers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSpot(): ?Spot
    {
        return $this->idSpot;
    }

    public function setIdSpot(?Spot $idSpot): self
    {
        $this->idSpot = $idSpot;

        return $this;
    }

    public function getIdSport(): ?Sport
    {
        return $this->idSport;
    }

    public function setIdSport(?Sport $idSport): self
    {
        $this->idSport = $idSport;

        return $this;
    }
}
