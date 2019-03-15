<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SauvegardeRepository")
 */
class Sauvegarde
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idCompetition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCompetition(): ?int
    {
        return $this->idCompetition;
    }

    public function setIdCompetition(int $idCompetition): self
    {
        $this->idCompetition = $idCompetition;

        return $this;
    }
}
