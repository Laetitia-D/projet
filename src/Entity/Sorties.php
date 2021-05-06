<?php

namespace App\Entity;

use App\Repository\SortiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SortiesRepository::class)
 */
class Sorties
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCloture;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbMaxInscription;

    /**
     * @ORM\Column(type="string", length=600, nullable=true)
     */
    private $descriptionEtInfos;

    /**
     * @ORM\Column(type="integer")
     */
    private $organisateur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Etats::class, inversedBy="sorties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etats;

    /**
     * @ORM\ManyToOne(targetEntity=Participants::class, inversedBy="organisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sortiesOrganisees;

    /**
     * @ORM\ManyToMany(targetEntity=Participants::class, mappedBy="sorties")
     */
    private $participants;

    /**
     * @ORM\ManyToOne(targetEntity=Campus::class, inversedBy="siteOrganisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $campus;

    /**
     * @ORM\ManyToOne(targetEntity=Lieux::class, inversedBy="sorties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieux;

    /**
     * @ORM\OneToMany(targetEntity=Inscriptions::class, mappedBy="sorties")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateCloture(): ?\DateTimeInterface
    {
        return $this->dateCloture;
    }

    public function setDateCloture(\DateTimeInterface $dateCloture): self
    {
        $this->dateCloture = $dateCloture;

        return $this;
    }

    public function getNbMaxInscription(): ?int
    {
        return $this->nbMaxInscription;
    }

    public function setNbMaxInscription(int $nbMaxInscription): self
    {
        $this->nbMaxInscription = $nbMaxInscription;

        return $this;
    }

    public function getDescriptionEtInfos(): ?string
    {
        return $this->descriptionEtInfos;
    }

    public function setDescriptionEtInfos(?string $descriptionEtInfos): self
    {
        $this->descriptionEtInfos = $descriptionEtInfos;

        return $this;
    }

    public function getOrganisateur(): ?int
    {
        return $this->organisateur;
    }

    public function setOrganisateur(int $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(?int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getEtats(): ?Etats
    {
        return $this->etats;
    }

    public function setEtats(?Etats $etats): self
    {
        $this->etats = $etats;

        return $this;
    }

    public function getSortiesOrganisees(): ?Participants
    {
        return $this->sortiesOrganisees;
    }

    public function setSortiesOrganisees(?Participants $sortiesOrganisees): self
    {
        $this->sortiesOrganisees = $sortiesOrganisees;

        return $this;
    }

    /**
     * @return Collection|Participants[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participants $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->addSorty($this);
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            $participant->removeSorty($this);
        }

        return $this;
    }

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function setCampus(?Campus $campus): self
    {
        $this->campus = $campus;

        return $this;
    }

    public function getLieux(): ?Lieux
    {
        return $this->lieux;
    }

    public function setLieux(?Lieux $lieux): self
    {
        $this->lieux = $lieux;

        return $this;
    }

    /**
     * @return Collection|Inscriptions[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscriptions $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setSorties($this);
        }

        return $this;
    }

    public function removeInscription(Inscriptions $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getSorties() === $this) {
                $inscription->setSorties(null);
            }
        }

        return $this;
    }
}
