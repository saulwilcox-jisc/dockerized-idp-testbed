<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\PaymentMethod;
use App\Entity\ProductOptionType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductOptionTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $productOptionType = new ProductOptionType();
        $productOptionType->setName('text');
        $manager->persist($productOptionType);

        $productOptionType = new ProductOptionType();
        $productOptionType->setName('textarea');
        $manager->persist($productOptionType);

        $productOptionType = new ProductOptionType();
        $productOptionType->setName('datetime');
        $manager->persist($productOptionType);

        $productOptionType = new ProductOptionType();
        $productOptionType->setName('select');
        $manager->persist($productOptionType);

        $productOptionType = new ProductOptionType();
        $productOptionType->setName('radio');
        $manager->persist($productOptionType);

        $productOptionType = new ProductOptionType();
        $productOptionType->setName('switch');
        $manager->persist($productOptionType);

        $productOptionType = new ProductOptionType();
        $productOptionType->setName('checkbox');
        $manager->persist($productOptionType);

        $manager->flush();
    }
}
