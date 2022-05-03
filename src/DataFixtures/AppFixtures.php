<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tShirtCategory = new Category();
        $tShirtCategory->setName('T-shirts');

        $shoeCategory = new Category();
        $shoeCategory->setName('Chaussures');

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setDescription('product desc '.$i);
            $product->setSize('size');
            $product->setKeyWords(['mot 1', 'mot 2', 'mot 3']);

            if((random_int(0,1)) === 0){
                $tShirtCategory->addProduct($product);
            }else{
                $shoeCategory->addProduct($product);
            }

            $manager->persist($product);
        }

        $manager->persist($tShirtCategory);
        $manager->persist($shoeCategory);

        $manager->flush();
    }
}