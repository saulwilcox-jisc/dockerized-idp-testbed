<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Step;

class StepFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $step = new Step();
        $step->setName('Product options')
            ->setTitle('Configure your product')
            ->setComponent('ProductOptions');
        $manager->persist($step);

        $step = new Step();
        $step->setName('Contacts')
            ->setTitle('Contacts')
            ->setComponent('Contacts');
        $manager->persist($step);

        $step = new Step();
        $step->setName('Payment')
            ->setTitle('Payment')
            ->setComponent('Payment');
        $manager->persist($step);
        $step = new Step();
        $step->setName('Legal and terms')
            ->setTitle('Legal and terms')
            ->setComponent('LegalTerms');
        $manager->persist($step);
        $step = new Step();
        $step->setName('Summary')
            ->setTitle('Summary')
            ->setComponent('Summary');
        $manager->persist($step);

        $manager->flush();
    }
}
