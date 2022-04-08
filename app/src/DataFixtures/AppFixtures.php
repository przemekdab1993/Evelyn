<?php

namespace App\DataFixtures;

use App\Entity\Doc;
use App\Entity\DocRating;
use App\Factory\AuthorFactory;
use App\Factory\CommentFactory;
use App\Factory\DocAuthorFactory;
use App\Factory\DocFactory;
use App\Factory\TagFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        UserFactory::createMany(5);
        UserFactory::createOne([
            'email' => 'przemekdab1993@gmail.com',
            'plainPassword' => 'duda',
            'status' => 'active',
            'roles' => ['ROLE_SUPER_ADMIN']
        ]);
        UserFactory::createOne([
            'email' => 'ewelinak1996@gmail.com',
            'plainPassword' => 'kula',
            'status' => 'active',
            'roles' => ['ROLE_ADMIN']
        ]);

        TagFactory::createMany(60);
        AuthorFactory::createMany(5);


        DocFactory::createMany(20, function() {
            return [
                'docAuthors' => DocAuthorFactory::new( function() {
                    return ['author' => AuthorFactory::random()];
                })->many(1)
            ];
        });



        CommentFactory::createMany(50, function () {
            return ['owner' => UserFactory::random()];
        });
        CommentFactory::new()->needsApproval()->many(10)->create(function () {
            return ['owner' => UserFactory::random()];
        });

    }
}
