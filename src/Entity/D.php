<?php

namespace App\Entity;

use App\Repository\DRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DRepository::class)
 */
class D
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=d::class, cascade={"persist", "remove"})
     */
    private $D;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getD(): ?d
    {
        return $this->D;
    }

    public function setD(?d $D): self
    {
        $this->D = $D;

        return $this;
    }
}
