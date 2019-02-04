<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RowRepository")
 */
class Row
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $numTour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dance", inversedBy="rows")
     */
    private $dance;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", inversedBy="rows")
     */
    private $teams;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="rows")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $formation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $piste;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passageSimul;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumTour()
    {
        return $this->numTour;
    }

    public function setNumTour($numTour): self
    {
        $this->numTour = $numTour;

        return $this;
    }

    public function getDance(): ?Dance
    {
        return $this->dance;
    }

    public function setDance(?Dance $dance): self
    {
        $this->dance = $dance;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(?string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getPiste(): ?string
    {
        return $this->piste;
    }

    public function setPiste(?string $piste): self
    {
        $this->piste = $piste;

        return $this;
    }

    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(?bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

	/**
	 * @return mixed
	 */
	public function getPassageSimul() {
		return $this->passageSimul;
	}

	/**
	 * @param mixed $passageSimul
	 */
	public function setPassageSimul($passageSimul) {
		$this->passageSimul = $passageSimul;
	}


}
