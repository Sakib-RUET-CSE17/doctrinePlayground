<?php

namespace App\EntityListener;

use App\Entity\Customer;
use App\Entity\Settings;
use App\Repository\SettingsRepository;
use Doctrine\ORM\Event\LifecycleEventArgs;

class CustomerEntityListener
{

    public function __construct(private SettingsRepository $settingsRepository)
    {
    }

    public function prePersist(Customer $customer, LifecycleEventArgs $event)
    {
        // $customerSettings = $this->settingsRepository->findOneBy(['entity' => 'Customer']);
        // // dd($customerSettings);
        // if ($customerSettings) {
        //     $customer->setSetting($customerSettings);
        //     $extraFields = $customerSettings->getFields();
        //     foreach ($extraFields as $field) {
        //         $fieldName = $field->getName();
        //         $fieldType = $field->getType();
        //         dump($fieldName . '-' . $fieldType);
        //     }
        // } else {
        //     // $customerSettings = ;
        //     $customerSettings->setEntity('Customer');
        //     $customer->setSetting($customerSettings);
        // }
    }

    // public function preUpdate(Conference $conference, LifecycleEventArgs $event)
    // {
    //     $conference->computeSlug($this->slugger);
    // }
}
