<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SportRepository::class)
 */
class Sport
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
    private $nomPratique;

    /**
     * @ORM\OneToMany(targetEntity=PeutSePratiquer::class, mappedBy="idSport", orphanRemoval=true)
     */
    private $peutSePratiquers;

    /**
     * @ORM\OneToMany(targetEntity=Session::class, mappedBy="idSport")
     */
    private $sessions;

    public function __construct()
    {
        $this->peutSePratiquers = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPratique(): ?string
    {
        return $this->nomPratique;
    }

    public function setNomPratique(string $nomPratique): self
    {
        $this->nomPratique = $nomPratique;

        return $this;
    }

    /**
     * @return Collection|PeutSePratiquer[]
     */
    public function getPeutSePratiquers(): Collection
    {
        return $this->peutSePratiquers;
    }

    public function addPeutSePratiquer(PeutSePratiquer $peutSePratiquer): self
    {
        if (!$this->peutSePratiquers->contains($peutSePratiquer)) {
            $this->peutSePratiquers[] = $peutSePratiquer;
            $peutSePratiquer->setIdSport($this);
        }

        return $this;
    }

    public function removePeutSePratiquer(PeutSePratiquer $peutSePratiquer): self
    {
        if ($this->peutSePratiquers->removeElement($peutSePratiquer)) {
            // set the owning side to null (unless already changed)
            if ($peutSePratiquer->getIdSport() === $this) {
                $peutSePratiquer->setIdSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setIdSport($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getIdSport() === $this) {
                $session->setIdSport(null);
            }
        }

        return $this;
    }
}
