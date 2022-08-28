<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer extends MagicGetSet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Purchase::class)]
    private Collection $purchases;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Settings $setting = null;

    // #[ORM\Column(nullable: true)]
    //  $data = [];

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
        // parent::__construct($this->data);
    }

    public function __toString()
    {
        return $this->name;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Purchase>
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases->add($purchase);
            $purchase->setCustomer($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): self
    {
        if ($this->purchases->removeElement($purchase)) {
            // set the owning side to null (unless already changed)
            if ($purchase->getCustomer() === $this) {
                $purchase->setCustomer(null);
            }
        }

        return $this;
    }

    public function getSetting(): ?Settings
    {
        return $this->setting;
    }

    public function setSetting(?Settings $setting): self
    {
        $this->setting = $setting;

        return $this;
    }

    // public function getData(): array
    // {
    //     return $this->data;
    // }

    // public function setData(?array $data): self
    // {
    //     $this->data = $data;

    //     return $this;
    // }

    // public function __set($name, $value)
    // {
    //     // echo "Setting '$name' to '$value'\n";
    //     // dd($name, $value);
    //     $this->data[$name] = $value;
    // }

    // public function __get($name)
    // {
    //     // echo "Getting '$name'\n";
    //     if (array_key_exists($name, $this->data)) {
    //         return $this->data[$name];
    //     }

    //     // $trace = debug_backtrace();
    //     // trigger_error(
    //     //     'Undefined property via __get(): ' . $name .
    //     //         ' in ' . $trace[0]['file'] .
    //     //         ' on line ' . $trace[0]['line'],
    //     //     E_USER_NOTICE
    //     // );
    //     return null;
    // }
}
