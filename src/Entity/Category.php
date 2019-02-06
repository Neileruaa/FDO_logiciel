<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("planning")
     */
    private $nameCategory;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Team", mappedBy="category", cascade={"persist", "remove"})
     */
    private $teams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Row", mappedBy="category",cascade={"remove"})
     */
    private $rows;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->rows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): self
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    public function __toString()
    {
         return $this->getNameCategory();
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
            $team->setCategory($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getCategory() === $this) {
                $team->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Row[]
     */
    public function getRows(): Collection
    {
        return $this->rows;
    }

    public function addRow(Row $row): self
    {
        if (!$this->rows->contains($row)) {
            $this->rows[] = $row;
            $row->setCategory($this);
        }

        return $this;
    }

    public function removeRow(Row $row): self
    {
        if ($this->rows->contains($row)) {
            $this->rows->removeElement($row);
            // set the owning side to null (unless already changed)
            if ($row->getCategory() === $this) {
                $row->setCategory(null);
            }
        }

        return $this;
    }


}
