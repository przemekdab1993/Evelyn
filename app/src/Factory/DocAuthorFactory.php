<?php

namespace App\Factory;

use App\Entity\DocAuthor;
use App\Repository\DocAuthorRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<DocAuthor>
 *
 * @method static DocAuthor|Proxy createOne(array $attributes = [])
 * @method static DocAuthor[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static DocAuthor|Proxy find(object|array|mixed $criteria)
 * @method static DocAuthor|Proxy findOrCreate(array $attributes)
 * @method static DocAuthor|Proxy first(string $sortedField = 'id')
 * @method static DocAuthor|Proxy last(string $sortedField = 'id')
 * @method static DocAuthor|Proxy random(array $attributes = [])
 * @method static DocAuthor|Proxy randomOrCreate(array $attributes = [])
 * @method static DocAuthor[]|Proxy[] all()
 * @method static DocAuthor[]|Proxy[] findBy(array $attributes)
 * @method static DocAuthor[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static DocAuthor[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DocAuthorRepository|RepositoryProxy repository()
 * @method DocAuthor|Proxy create(array|callable $attributes = [])
 */
final class DocAuthorFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'doc' => DocFactory::new(),
            'author' => AuthorFactory::random(),
            //'addAt' => self::faker()->datetime(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(DocAuthor $docAuthor): void {})
        ;
    }

    protected static function getClass(): string
    {
        return DocAuthor::class;
    }
}
