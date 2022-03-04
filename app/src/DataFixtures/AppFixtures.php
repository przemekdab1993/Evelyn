<?php

namespace App\DataFixtures;

use App\Entity\Doc;
use App\Entity\DocRating;
use App\Factory\AuthorFactory;
use App\Factory\CommentFactory;
use App\Factory\DocAuthorFactory;
use App\Factory\DocFactory;
use App\Factory\TagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //UserFactory::createMany(5);
        TagFactory::createMany(60);
        AuthorFactory::createMany(5);


        DocFactory::createMany(20, function() {
            return [
                'docAuthors' => DocAuthorFactory::new( function() {
                    return ['author' => AuthorFactory::random()];
                })->many(1)
            ];
        });



        CommentFactory::createMany(50);
        CommentFactory::new()->needsApproval()->many(10)->create();

    }
}
