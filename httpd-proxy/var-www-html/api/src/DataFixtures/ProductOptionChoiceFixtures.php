<?php

namespace App\DataFixtures;

use App\Entity\ProductOption;
use App\Entity\ProductOptionChoice;
use App\Entity\ProductOptionGroup;
use App\Entity\ProductOptionType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductOptionChoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            ProductOptionGroupFixtures::class,
            ProductOptionTypeFixtures::class,
            ProductOptionFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        // Form group 1
        $productOption = $manager->getRepository(ProductOption::class)->findOneBy(['name' => 'Choice 1']);
        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('option 1')
            ->setProductOption($productOption)
            ->setValue(1);
        $manager->persist($productOptionChoice);

        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('option 2')
            ->setProductOption($productOption)
            ->setValue(2);
        $manager->persist($productOptionChoice);

        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('option 3')
            ->setProductOption($productOption)
            ->setValue(3);
        $manager->persist($productOptionChoice);

        $productOption = $manager->getRepository(ProductOption::class)->findOneBy(['name' => 'Choice 2']);
        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('option 4')
            ->setProductOption($productOption)
            ->setValue(4);
        $manager->persist($productOptionChoice);

        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('option 5')
            ->setProductOption($productOption)
            ->setValue(5);
        $manager->persist($productOptionChoice);

        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('option 6')
            ->setProductOption($productOption)
            ->setValue(6);
        $manager->persist($productOptionChoice);

        // Form group 2
        $productOption = $manager->getRepository(ProductOption::class)->findOneBy(['name' => 'Radio group']);
        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('Radio option 1')
            ->setProductOption($productOption)
            ->setValue(1);
        $manager->persist($productOptionChoice);

        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('Radio option 2')
            ->setProductOption($productOption)
            ->setValue(2);
        $manager->persist($productOptionChoice);

        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('Radio option 3')
            ->setProductOption($productOption)
            ->setValue(3);
        $manager->persist($productOptionChoice);

        $productOptionChoice = new ProductOptionChoice();
        $productOptionChoice
            ->setName('Radio option 4')
            ->setProductOption($productOption)
            ->setValue(4);
        $manager->persist($productOptionChoice);

        $manager->flush();

    }
}
