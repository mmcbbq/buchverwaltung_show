<?php

namespace App\DataFixtures;

use App\Factory\AuthorFactory;
use App\Factory\BookFactory;
use App\Factory\SupplierFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        AuthorFactory::createMany(30);


        BookFactory::createMany(100,function (){
            return ["author" => AuthorFactory::random()];
        });

        SupplierFactory::createMany(5, function (){
            return ['books'=>BookFactory::randomRange(1,5)];
        });

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
