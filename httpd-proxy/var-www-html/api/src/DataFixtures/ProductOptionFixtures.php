<?php

namespace App\DataFixtures;

use App\Entity\ProductOption;
use App\Entity\ProductOptionGroup;
use App\Entity\ProductOptionType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductOptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            ProductOptionGroupFixtures::class,
            ProductOptionTypeFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        // Form group 1
        $productOptionGroup = $manager->getRepository(ProductOptionGroup::class)->findOneBy(['name' => 'Something that is configurable']);
        $productIOptionType = $manager->getRepository(ProductOptionType::class)->findOneBy(['name' => 'select']);
        $productOption = new ProductOption();
        $productOption
            ->setProductOptionGroup($productOptionGroup)
            ->setProductOptionType($productIOptionType)
            ->setName('Choice 1')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ');
        $manager->persist($productOption);

        $productOption = new ProductOption();
        $productOption
            ->setProductOptionGroup($productOptionGroup)
            ->setProductOptionType($productIOptionType)
            ->setName('Choice 2')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ');
        $manager->persist($productOption);

        // Form group 2
        $productOptionGroup = $manager->getRepository(ProductOptionGroup::class)->findOneBy(['name' => 'More stuff']);
        $productIOptionType = $manager->getRepository(ProductOptionType::class)->findOneBy(['name' => 'radio']);
        $productOption = new ProductOption();
        $productOption
            ->setProductOptionGroup($productOptionGroup)
            ->setProductOptionType($productIOptionType)
            ->setName('Radio group')
            ->setDescription('Some description');
        $manager->persist($productOption);

        $manager->flush();
    }
}
