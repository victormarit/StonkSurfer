<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $notePerformance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $noteEcologique;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $noteEstimationAPI;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $noteInfrastructure;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateSessionDebut;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $dureeSession;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $photos = [];

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $public;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class, inversedBy="sessions")
     */
    private $idSport;

    /**
     * @ORM\ManyToOne(targetEntity=Spot::class, inversedBy="sessions")
     */
    private $idSpot;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="sessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUtilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotePerformance(): ?float
    {
        return $this->notePerformance;
    }

    public function setNotePerformance(?float $notePerformance): self
    {
        $this->notePerformance = $notePerformance;

        return $this;
    }

    public function getNoteEcologique(): ?float
    {
        return $this->noteEcologique;
    }

    public function setNoteEcologique(?float $noteEcologique): self
    {
        $this->noteEcologique = $noteEcologique;

        return $this;
    }

    public function getNoteEstimationAPI(): ?float
    {
        return $this->noteEstimationAPI;
    }

    public function setNoteEstimationAPI(?float $noteEstimationAPI): self
    {
        $this->noteEstimationAPI = $noteEstimationAPI;

        return $this;
    }

    public function getNoteInfrastructure(): ?float
    {
        return $this->noteInfrastructure;
    }

    public function setNoteInfrastructure(?float $noteInfrastructure): self
    {
        $this->noteInfrastructure = $noteInfrastructure;

        return $this;
    }

    public function getDateSessionDebut(): ?\DateTimeInterface
    {
        return $this->dateSessionDebut;
    }

    public function setDateSessionDebut(\DateTimeInterface $dateSessionDebut): self
    {
        $this->dateSessionDebut = $dateSessionDebut;

        return $this;
    }

    public function getDureeSession(): ?\DateTimeInterface
    {
        return $this->dureeSession;
    }

    public function setDureeSession(?\DateTimeInterface $dureeSession): self
    {
        $this->dureeSession = $dureeSession;

        return $this;
    }

    public function getPhotos(): ?array
    {
        return $this->photos;
    }

    public function setPhotos(?array $photos): self
    {
        $this->photos = $photos;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getPublic(): ?bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;

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

    public function getIdSpot(): ?Spot
    {
        return $this->idSpot;
    }

    public function setIdSpot(?Spot $idSpot): self
    {
        $this->idSpot = $idSpot;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
