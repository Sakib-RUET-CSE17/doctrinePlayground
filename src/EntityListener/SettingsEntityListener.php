<?php

namespace App\EntityListener;

use App\Entity\Settings;
use Doctrine\ORM\Event\LifecycleEventArgs;

class SettingsEntityListener
{

    public function __construct()
    {
    }

    public function prePersist(Settings $settings, LifecycleEventArgs $event)
    {
        $entity = $settings->getEntity();
        // dd($entity);
        switch ($entity) {
            case 'Customer':
                # code...
                break;

            default:
                # code...
                break;
        }
        // // $products = $purchase->getProducts();
        // $amount = 0;
        // foreach ($products as $product) {
        //     $amount += $product->getPrice();
        // }
        // // dd($purchase, $amount);

        // $bill = new Bill();
        // $bill->setAmount($amount);
        // $purchase->setBill($bill);
    }

    // public function preUpdate(Conference $conference, LifecycleEventArgs $event)
    // {
    //     $conference->computeSlug($this->slugger);
    // }
}
