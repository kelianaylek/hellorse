<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher){
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@hellorse.fr');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'hellorse'));
        $manager->persist($user);

        $tShirtCategory = new Category();
        $tShirtCategory->setName('T-shirts');

        $shoeCategory = new Category();
        $shoeCategory->setName('Chaussures');

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setDescription('product desc '.$i);
            $product->setKeyWords(['wordProduct' .$i ]);

            if((random_int(0,1)) === 0){
                $tShirtCategory->addProduct($product);
                $sizes = ['XS', 'S', 'M',' L', 'XL'];
                $product->setSize($sizes[array_rand($sizes)]);
            }else{
                $shoeCategory->addProduct($product);
                $sizes = ['38', '39', '40',' 41', '42', '43', '44', '45', '46'];
                $product->setSize($sizes[array_rand($sizes)]);
            }

            $manager->persist($product);
        }

        $manager->persist($tShirtCategory);
        $manager->persist($shoeCategory);

        $manager->flush();
    }
}
