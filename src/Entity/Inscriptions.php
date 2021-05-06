<?php

namespace App\Entity;

use App\Repository\InscriptionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionsRepository::class)
 */
class Inscriptions
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
    private $dateInscription;

    /**
     * @ORM\ManyToOne(targetEntity=Participants::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $participants;

    /**
     * @ORM\ManyToOne(targetEntity=Sorties::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sorties;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getParticipants(): ?Participants
    {
        return $this->participants;
    }

    public function setParticipants(?Participants $participants): self
    {
        $this->participants = $participants;

        return $this;
    }

    public function getSorties(): ?Sorties
    {
        return $this->sorties;
    }

    public function setSorties(?Sorties $sorties): self
    {
        $this->sorties = $sorties;

        return $this;
    }
}
