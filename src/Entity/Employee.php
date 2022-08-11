<?php

namespace App\Entity;

// use Doctrine\ORM\Mapping\Column;
// use Doctrine\ORM\Mapping\JoinColumn;
// use Doctrine\ORM\Mapping\OneToOne;
// use Doctrine\ORM\Mapping\Id;
// use Doctrine\ORM\Mapping\MappedSuperclass;
// use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Employee extends Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** @Column(type="string") */
    #[ORM\Column(nullable: true)]
    private ?string $name = null;

    // ... more fields and methods

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
