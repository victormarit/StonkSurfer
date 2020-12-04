<?php

namespace App\Entity;

use App\Repository\SpotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Object_;

/**
 * @ORM\Entity(repositoryClass=SpotRepository::class)
 */
class Spot
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
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $niveauAccessibilite;

    /**
     * @ORM\ManyToOne(targetEntity=Plage::class, inversedBy="spots")
     */
    private $idPlage;

    /**
     * @ORM\OneToMany(targetEntity=PeutSePratiquer::class, mappedBy="idSpot")
     */
    private $peutSePratiquers;

    /**
     * @ORM\OneToMany(targetEntity=Session::class, mappedBy="idSpot")
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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getNiveauAccessibilite(): ?float
    {
        return $this->niveauAccessibilite;
    }

    public function setNiveauAccessibilite(?float $niveauAccessibilite): self
    {
        $this->niveauAccessibilite = $niveauAccessibilite;

        return $this;
    }

    public function getIdPlage(): ?object
    {
        return $this->idPlage;
    }

    public function setIdPlage(?object $idPlage): self
    {
        $this->idPlage = $idPlage;

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
            $peutSePratiquer->setIdSpot($this);
        }

        return $this;
    }

    public function removePeutSePratiquer(PeutSePratiquer $peutSePratiquer): self
    {
        if ($this->peutSePratiquers->removeElement($peutSePratiquer)) {
            // set the owning side to null (unless already changed)
            if ($peutSePratiquer->getIdSpot() === $this) {
                $peutSePratiquer->setIdSpot(null);
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
            $session->setIdSpot($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getIdSpot() === $this) {
                $session->setIdSpot(null);
            }
        }

        return $this;
    }
}
