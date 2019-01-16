<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DancerRepository")
 */
class Dancer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="2", minMessage="Votre nom doit faire au moins 2 caractères")
     */
    private $nameDancer;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="2", minMessage="Votre prénom doit faire au moins 2 caractères")
     */
    private $firstNameDancer;

    /**
     * @ORM\Column(type="date")
     */
    private $dateBirthDancer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $emailDancer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", mappedBy="dancers")
     * @ORM\JoinTable(name="dancer_team")
     */
    private $teams;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="dancers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAuthorized;

    public function __construct()
    {
        $this->team = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->club = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameDancer(): ?string
    {
        return $this->nameDancer;
    }

    public function setNameDancer(string $nameDancer): self
    {
        $this->nameDancer = $nameDancer;

        return $this;
    }

    public function getFirstNameDancer(): ?string
    {
        return $this->firstNameDancer;
    }

    public function setFirstNameDancer(string $firstNameDancer): self
    {
        $this->firstNameDancer = $firstNameDancer;

        return $this;
    }

    public function getDateBirthDancer(): ?\DateTimeInterface
    {
        return $this->dateBirthDancer;
    }

    public function setDateBirthDancer(\DateTimeInterface $dateBirthDancer): self
    {
        $this->dateBirthDancer = $dateBirthDancer;

        return $this;
    }

    public function getEmailDancer(): ?string
    {
        return $this->emailDancer;
    }

    public function setEmailDancer(?string $emailDancer): self
    {
        $this->emailDancer = $emailDancer;

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
            $team->addDancer($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            $team->removeDancer($this);
        }

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    public function getIsAuthorized(): ?bool
    {
        return $this->isAuthorized;
    }

    public function setIsAuthorized(bool $isAuthorized): self
    {
        $this->isAuthorized = $isAuthorized;

        return $this;
    }
}
