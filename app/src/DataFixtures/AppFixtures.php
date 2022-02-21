<?php

namespace App\DataFixtures;

use App\Entity\Doc;
use App\Entity\DocRating;
use App\Factory\CommentFactory;
use App\Factory\DocFactory;
use App\Factory\TagFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        UserFactory::new()->createMany(5);
        TagFactory::new()->createMany(60);

        DocFactory::new()->createMany(20);

        CommentFactory::new()->createMany(50);
        CommentFactory::new()->needsApproval()->many(10)->create();

    }
}
