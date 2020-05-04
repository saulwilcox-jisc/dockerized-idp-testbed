<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\PaymentMethod;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PaymentMethodFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $paymentMethod = new PaymentMethod();
        $paymentMethod->setName('Pay on account')
            ->setCode('ACCOUNT');
        $manager->persist($paymentMethod);
        $paymentMethod = new PaymentMethod();
        $paymentMethod->setName('Credit Card')
            ->setCode('CREDIT_CARD');
        $manager->persist($paymentMethod);

        $manager->flush();
    }
}
