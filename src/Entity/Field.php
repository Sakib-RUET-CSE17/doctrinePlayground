<?php

namespace App\Entity;

use App\Repository\FieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FieldRepository::class)]
class Field
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'fields')]
    private ?Settings $settings = null;

    #[ORM\OneToMany(mappedBy: 'field', targetEntity: FieldConstraint::class)]
    private Collection $fieldConstraints;

    public function __construct()
    {
        $this->fieldConstraints = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name . '(' . $this->type . ')';
    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSettings(): ?Settings
    {
        return $this->settings;
    }

    public function setSettings(?Settings $settings): self
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * @return Collection<int, FieldConstraint>
     */
    public function getFieldConstraints(): Collection
    {
        return $this->fieldConstraints;
    }

    public function addFieldConstraint(FieldConstraint $fieldConstraint): self
    {
        if (!$this->fieldConstraints->contains($fieldConstraint)) {
            $this->fieldConstraints->add($fieldConstraint);
            $fieldConstraint->setField($this);
        }

        return $this;
    }

    public function removeFieldConstraint(FieldConstraint $fieldConstraint): self
    {
        if ($this->fieldConstraints->removeElement($fieldConstraint)) {
            // set the owning side to null (unless already changed)
            if ($fieldConstraint->getField() === $this) {
                $fieldConstraint->setField(null);
            }
        }

        return $this;
    }
}
