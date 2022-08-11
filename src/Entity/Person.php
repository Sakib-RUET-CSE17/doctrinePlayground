<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass()]
class Person
{
    /** @Column(type="integer") */
    #[ORM\Column(nullable: true)]
    protected ?int $mapped1;

    /** @Column(type="string") */
    #[ORM\Column(nullable: true)]
    protected ?string $mapped2;

    /**
     * @OneToOne(targetEntity="Toothbrush")
     * @JoinColumn(name="toothbrush_id", referencedColumnName="id")
     */
    #[ORM\OneToOne(inversedBy: 'person', cascade: ['persist', 'remove'])]
    protected ?Toothbrush $toothbrush;

    // ... more fields and methods
}
