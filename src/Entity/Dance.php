<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DanceRepository")
 */
class Dance
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
    private $nameDance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Row", mappedBy="dance",cascade={"remove"})
     */
    private $rows;

    public function __construct()
    {
        $this->rows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameDance(): ?string
    {
        return $this->nameDance;
    }

    public function setNameDance(string $nameDance): self
    {
        $this->nameDance = $nameDance;

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
            $row->setDance($this);
        }

        return $this;
    }

    public function removeRow(Row $row): self
    {
        if ($this->rows->contains($row)) {
            $this->rows->removeElement($row);
            // set the owning side to null (unless already changed)
            if ($row->getDance() === $this) {
                $row->setDance(null);
            }
        }

        return $this;
    }
}
