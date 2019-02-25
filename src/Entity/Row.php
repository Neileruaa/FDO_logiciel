<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RowRepository")
 */
class Row
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("planning")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups("planning")
     */
    private $numTour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dance", inversedBy="rows")
     * @Groups("planning")
     */
    private $dance;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", inversedBy="rows")
     * @Groups("planning")
     */
    private $teams;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="rows")
     * @Groups("planning")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("planning")
     */
    private $formation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("planning")
     */
    private $piste;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("planning")
     */
    private $isDone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("planning")
     */
    private $passageSimul;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="rows")
     */
    private $competition;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("planning")
     */
    private $nbJudge;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resultat", mappedBy="row", cascade={"remove"})
     */
    private $results;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->results = new ArrayCollection();
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

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }

    public function getNbJudge(): ?int
    {
        return $this->nbJudge;
    }

    public function setNbJudge(?int $nbJudge): self
    {
        $this->nbJudge = $nbJudge;

        return $this;
    }

    /**
     * @return Collection|Resultat[]
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    public function addResult(Resultat $result): self
    {
        if (!$this->results->contains($result)) {
            $this->results[] = $result;
            $result->setRow($this);
        }

        return $this;
    }

    public function removeResult(Resultat $result): self
    {
        if ($this->results->contains($result)) {
            $this->results->removeElement($result);
            // set the owning side to null (unless already changed)
            if ($result->getRow() === $this) {
                $result->setRow(null);
            }
        }

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }


}
