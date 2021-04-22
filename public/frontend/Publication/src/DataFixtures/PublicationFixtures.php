<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Publication;

class PublicationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i = 1;$i<=2;$i++)
        {
            $pub = new Publication();
            $pub->setDate(new \DateTime());
            $pub->setId_user(1);
            $pub->setLikes(0);
            $pub->setTexte("Test".$i);
            $manager->persist($pub);

        }
        $manager->flush();
    }
}
