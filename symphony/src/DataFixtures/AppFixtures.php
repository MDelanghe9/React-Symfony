<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $faker = Factory::create('fr_FR');
        $catname = ['piano', 'guitare', 'violon', 'flute'];
        foreach ($catname as $key => $value) {
            $cat = new Category();
            $cat->setName($value);
            $manager->persist($cat);

            for($i=0; $i < 10; $i++){
                $pro = new Product();
                $pro->setName($faker->company);
                $pro->setPrice($faker->randomFloat(2, 250, 5000));
                $pro->setDetail('str');
                $pro->setBrand($faker->randomElement(['Yama', 'Bll', 'Sonyy', 'Blid', 'Rick']));
                $pro->setStock(rand(0, 25));
                $pro->setCategory($cat);
                $manager->persist($pro);
            }
        }
        $manager->flush();
    }
    
}
