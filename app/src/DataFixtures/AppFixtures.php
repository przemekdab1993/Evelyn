<?php

namespace App\DataFixtures;

use App\Entity\Doc;
use App\Entity\DocRating;
use App\Factory\DocFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        DocFactory::new()->createMany(10);
        UserFactory::new()->createMany(5);
    }
}
