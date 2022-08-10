<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillRepository::class)]
class Bill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $amount = null;

    #[ORM\OneToOne(mappedBy: 'bill', cascade: ['persist', 'remove'])]
    private ?Purchase $purchase = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPurchase(): ?Purchase
    {
        return $this->purchase;
    }

    public function setPurchase(?Purchase $purchase): self
    {
        // unset the owning side of the relation if necessary
        if ($purchase === null && $this->purchase !== null) {
            $this->purchase->setBill(null);
        }

        // set the owning side of the relation if necessary
        if ($purchase !== null && $purchase->getBill() !== $this) {
            $purchase->setBill($this);
        }

        $this->purchase = $purchase;

        return $this;
    }
}
