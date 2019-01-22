<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JudgeRepository")
 */
class Judge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameJudge;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstNameJudge;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Competition", mappedBy="judges")
     */
    private $competitions;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameJudge(): ?string
    {
        return $this->nameJudge;
    }

    public function setNameJudge(string $nameJudge): self
    {
        $this->nameJudge = $nameJudge;

        return $this;
    }

    public function getFirstNameJudge(): ?string
    {
        return $this->firstNameJudge;
    }

    public function setFirstNameJudge(string $firstNameJudge): self
    {
        $this->firstNameJudge = $firstNameJudge;

        return $this;
    }

    /**
     * @return Collection|Competition[]
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): self
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions[] = $competition;
            $competition->addJudge($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competitions->contains($competition)) {
            $this->competitions->removeElement($competition);
            $competition->removeJudge($this);
        }

        return $this;
    }
}
