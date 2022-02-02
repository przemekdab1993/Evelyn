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
            'title' => 'Nowy dokument',
            'lead' => 'Dicta nostrum voluptatibus placeat temporibus omnis.',
            'content' => self::faker()->text(),
            'createdDate' => new \DateTime(),
            'docRating' => new DocRating(),
            'active' => true,
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Doc $doc): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Doc::class;
    }
}
