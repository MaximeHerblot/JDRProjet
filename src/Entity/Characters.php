<?php

namespace App\Entity;

use App\Repository\CharactersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharactersRepository::class)
 */
class Characters
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Firstname;

    /**
     * @ORM\Column(type="integer")
     */
    private $Age;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreationDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\ManyToOne(targetEntity=Race::class, inversedBy="Characters")
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="characters")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->CreationDate;
    }

    public function setCreationDate(?\DateTimeInterface $CreationDate): self
    {
        $this->CreationDate = $CreationDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
