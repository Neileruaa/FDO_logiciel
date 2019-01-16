<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MailboxRepository")
 */
class Mailbox
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $message;

    //faire une relation avec club

    /**
     * @ORM\Column(type="integer", nullable=false)
     *
     */
    private $Club;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getClub(): ?int
    {
        return $this->Club;
    }

    public function setClub(int $Club): self
    {
        $this->Club = $Club;

        return $this;
    }
}
