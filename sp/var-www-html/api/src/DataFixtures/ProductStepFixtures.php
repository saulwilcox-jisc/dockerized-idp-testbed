<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductStep;
use App\Entity\Step;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductStepFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            StepFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $product = $manager->getRepository(Product::class)->findOneBy(['name' => 'Something X-ray']);
        $step = $manager->getRepository(Step::class)->findOneBy(['name' => 'Product options']);
        $productStep = new ProductStep();
        $productStep->setProduct($product)
            ->setStep($step)
            ->setDisplayOrder(1);
        $manager->persist($productStep);

        $product = $manager->getRepository(Product::class)->findOneBy(['name' => 'Something X-ray']);
        $step = $manager->getRepository(Step::class)->findOneBy(['name' => 'Contacts']);
        $productStep = new ProductStep();
        $productStep->setProduct($product)
            ->setStep($step)
            ->setDisplayOrder(2);
        $manager->persist($productStep);

        $product = $manager->getRepository(Product::class)->findOneBy(['name' => 'Something X-ray']);
        $step = $manager->getRepository(Step::class)->findOneBy(['name' => 'Payment']);
        $productStep = new ProductStep();
        $productStep->setProduct($product)
            ->setStep($step)
            ->setDisplayOrder(3);
        $manager->persist($productStep);

        $product = $manager->getRepository(Product::class)->findOneBy(['name' => 'Something X-ray']);
        $step = $manager->getRepository(Step::class)->findOneBy(['name' => 'Legal and terms']);
        $productStep = new ProductStep();
        $productStep->setProduct($product)
            ->setStep($step)
            ->setDisplayOrder(4);
        $manager->persist($productStep);

        $product = $manager->getRepository(Product::class)->findOneBy(['name' => 'Something X-ray']);
        $step = $manager->getRepository(Step::class)->findOneBy(['name' => 'Summary']);
        $productStep = new ProductStep();
        $productStep->setProduct($product)
            ->setStep($step)
            ->setDisplayOrder(5);
        $manager->persist($productStep);

        $manager->flush();
    }
}
