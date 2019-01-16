<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $nameDance;

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
}
