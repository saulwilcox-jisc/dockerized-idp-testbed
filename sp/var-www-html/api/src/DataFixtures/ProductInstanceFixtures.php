<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Product;
use App\Entity\ProductInstance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductInstanceFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            AccountFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $product = $manager->getRepository(Product::class)->findOneBy(['name' => 'Something X-ray']);
        $account = $manager->getRepository(Account::class)->findOneBy(['name' => 'University of Jisc']);
        $productInstance = new ProductInstance();
        $productInstance->setProduct($product)
            ->setAccount($account);
        $manager->persist($productInstance);
        $manager->flush();
    }
}
