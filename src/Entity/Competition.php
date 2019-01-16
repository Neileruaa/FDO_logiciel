<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionRepository")
 */
class Competition
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="date")
     */
    private $dateCompetition;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $teams;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Dance")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dances;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="competitions")
     */
    private $clubOrganizer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=0)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=0)
     */
    private $nbMaxTeam;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $description;


    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->place = new ArrayCollection();
        $this->dances = new ArrayCollection();
        $this->clubOrganizer = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCompetition(): ?\DateTimeInterface
    {
        return $this->dateCompetition;
    }

    public function setDateCompetition(\DateTimeInterface $dateCompetition): self
    {
        $this->dateCompetition = $dateCompetition;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
        }

        return $this;
    }

    /**
     * @return Collection|Dance[]
     */
    public function getDances(): Collection
    {
        return $this->dances;
    }

    public function addDance(Dance $dance): self
    {
        if (!$this->dances->contains($dance)) {
            $this->dances[] = $dance;
        }

        return $this;
    }

    public function removeDance(Dance $dance): self
    {
        if ($this->dances->contains($dance)) {
            $this->dances->removeElement($dance);
        }

        return $this;
    }

    public function getClubOrganizer()
    {
        return $this->clubOrganizer;
    }

    public function setClubOrganizer(?Club $clubOrganizer): self
    {
        $this->clubOrganizer = $clubOrganizer;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbMaxTeam()
    {
        return $this->nbMaxTeam;
    }

    public function setNbMaxTeam($nbMaxTeam): self
    {
        $this->nbMaxTeam = $nbMaxTeam;

        return $this;
    }
}
