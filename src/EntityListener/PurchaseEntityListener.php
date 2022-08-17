<?php

namespace App\EntityListener;

use App\Entity\Bill;
use App\Entity\Purchase;
use Doctrine\ORM\Event\LifecycleEventArgs;

class PurchaseEntityListener
{

    public function __construct()
    {
    }

    public function prePersist(Purchase $purchase, LifecycleEventArgs $event)
    {
        $products = $purchase->getProducts();
        $amount = 0;
        foreach ($products as $product) {
            $amount += $product->getPrice();
        }
        // dd($purchase, $amount);

        $bill = new Bill();
        $bill->setAmount($amount);
        $purchase->setBill($bill);
    }

    // public function preUpdate(Conference $conference, LifecycleEventArgs $event)
    // {
    //     $conference->computeSlug($this->slugger);
    // }
}
