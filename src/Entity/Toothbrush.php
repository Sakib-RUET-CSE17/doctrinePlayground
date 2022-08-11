<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Toothbrush
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'toothbrush', cascade: ['persist', 'remove'])]
    protected ?Person $person;
    // ... more fields and methods

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        // unset the owning side of the relation if necessary
        if ($person === null && $this->person !== null) {
            $this->person->setToothbrush(null);
        }

        // set the owning side of the relation if necessary
        if ($person !== null && $person->getToothbrush() !== $this) {
            $person->setToothbrush($this);
        }

        $this->person = $person;

        return $this;
    }
}
