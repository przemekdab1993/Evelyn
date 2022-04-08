<?php

namespace App\Factory;

use App\Entity\Doc;
use App\Entity\DocRating;
use App\Repository\DocRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Doc>
 *
 * @method static Doc|Proxy createOne(array $attributes = [])
 * @method static Doc[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Doc|Proxy find(object|array|mixed $criteria)
 * @method static Doc|Proxy findOrCreate(array $attributes)
 * @method static Doc|Proxy first(string $sortedField = 'id')
 * @method static Doc|Proxy last(string $sortedField = 'id')
 * @method static Doc|Proxy random(array $attributes = [])
 * @method static Doc|Proxy randomOrCreate(array $attributes = [])
 * @method static Doc[]|Proxy[] all()
 * @method static Doc[]|Proxy[] findBy(array $attributes)
 * @method static Doc[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Doc[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DocRepository|RepositoryProxy repository()
 * @method Doc|Proxy create(array|callable $attributes = [])
 */
final class DocFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'title' => self::faker()->realText(128),
            'lead' => self::faker()->realText(512),
            'content' => self::faker()->paragraphs(self::faker()->numberBetween(2,8), true),
            'createdDate' => self::faker()->dateTimeBetween('-60 days', 'now'),
            'docRating' => DocRatingFactory::new()->create(),
            'tags' => TagFactory::randomRange(1, 3),
            'owner' => UserFactory::random(),
            'active' => true,
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
//             ->afterInstantiate(function(Doc $doc, DocAuthor2 $docAuthor): void {
//                  $doc->addAuthor(DocAuthorFactory::create());
//             })
        ;
    }

    protected static function getClass(): string
    {
        return Doc::class;
    }
}