<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    /** @var Generator */
    protected $faker;

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        for ($i = 0; $i < 1000; $i++) {
            $customer = new Customer;
            $customer->setName($this->faker->name());
            $customer->setPhone($this->faker->phoneNumber());
            $email = $this->faker->email();
            $address = $this->faker->address();
            $purchasedCount = $this->faker->numberBetween(0, 1000);
            $customer->setData([
                'email' => $email,
                'address' => $address,
                'purchasedCount' => $purchasedCount,
            ]);
            $manager->persist($customer);
        }
        // $this->faker->createMany(
        //     Customer::class,
        //     10,
        //     function (Customer $customer, $count) {
        //         if ($this->faker->boolean(70)) {
        //         }
        //     }
        // );


        $manager->flush();
    }
}
