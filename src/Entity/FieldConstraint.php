<?php

namespace App\Entity;

use App\Repository\FieldConstraintRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FieldConstraintRepository::class)]
class FieldConstraint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classname = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $options = [];

    #[ORM\ManyToOne(inversedBy: 'fieldConstraints')]
    private ?Field $field = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->classname ? $this->classname : $this->id;
    }

    public function getClassname(): ?string
    {
        return $this->classname;
    }

    public function setClassname(?string $classname): self
    {
        $this->classname = $classname;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(?array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getField(): ?Field
    {
        return $this->field;
    }

    public function setField(?Field $field): self
    {
        $this->field = $field;

        return $this;
    }
}
