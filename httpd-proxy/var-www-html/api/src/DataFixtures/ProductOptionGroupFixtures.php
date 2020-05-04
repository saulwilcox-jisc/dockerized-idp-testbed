<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductOptionGroup;
use App\Entity\ProductStep;
use App\Entity\Step;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductOptionGroupFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $product = $manager->getRepository(Product::class)->findOneBy(['name' => 'Something X-ray']);
        $productOptionGroup = new ProductOptionGroup();
        $productOptionGroup->setProduct($product)
            ->setName('Something that is configurable')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ');
        $manager->persist($productOptionGroup);
        $productOptionGroup = new ProductOptionGroup();
        $productOptionGroup->setProduct($product)
            ->setName('More stuff')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ');
        $manager->persist($productOptionGroup);
        $productOptionGroup = new ProductOptionGroup();
        $productOptionGroup->setProduct($product)
            ->setName('Start date')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ');
        $manager->persist($productOptionGroup);
        $manager->flush();
    }
}
