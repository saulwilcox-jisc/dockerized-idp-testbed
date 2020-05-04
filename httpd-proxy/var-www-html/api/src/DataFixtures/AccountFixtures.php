<?php

namespace App\DataFixtures;

use App\Entity\Account;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AccountFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $account = new Account();
        $account->setName('University of Jisc')
            ->setJoid(1234)
            ->setExternalId('1')
            ->setVatCsgMember(false)
            ->setAccountType('Test Account')
            ->setTradingName('Jisc');
        $manager->persist($account);

        $manager->flush();
    }
}
