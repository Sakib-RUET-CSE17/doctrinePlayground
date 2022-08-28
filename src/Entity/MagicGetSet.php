<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

class MagicGetSet
{

    #[ORM\Column(nullable: true)]
    protected array $data = [];

    // public function __construct($data)
    // {
    //     dd($data);
    //     $this->data = $data;
    // }


    public function getData(): array
    {
        return $this->data;
    }

    public function setData(?array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function __set($name, $value)
    {
        // echo "Setting '$name' to '$value'\n";
        // dd($name, $value);
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        // echo "Getting '$name'\n";
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        // $trace = debug_backtrace();
        // trigger_error(
        //     'Undefined property via __get(): ' . $name .
        //         ' in ' . $trace[0]['file'] .
        //         ' on line ' . $trace[0]['line'],
        //     E_USER_NOTICE
        // );
        return null;
    }
}
