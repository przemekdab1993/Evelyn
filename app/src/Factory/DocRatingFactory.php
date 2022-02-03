<?php

namespace App\Factory;

use App\Entity\DocRating;
use App\Repository\DocRatingRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<DocRating>
 *
 * @method static DocRating|Proxy createOne(array $attributes = [])
 * @method static DocRating[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static DocRating|Proxy find(object|array|mixed $criteria)
 * @method static DocRating|Proxy findOrCreate(array $attributes)
 * @method static DocRating|Proxy first(string $sortedField = 'id')
 * @method static DocRating|Proxy last(string $sortedField = 'id')
 * @method static DocRating|Proxy random(array $attributes = [])
 * @method static DocRating|Proxy randomOrCreate(array $attributes = [])
 * @method static DocRating[]|Proxy[] all()
 * @method static DocRating[]|Proxy[] findBy(array $attributes)
 * @method static DocRating[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static DocRating[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DocRatingRepository|RepositoryProxy repository()
 * @method DocRating|Proxy create(array|callable $attributes = [])
 */
final class DocRatingFactory extends ModelFactory
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
            'good' => rand(1, 40),
            'bad' => rand(0, 20),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(DocRating $docRating): void {})
        ;
    }

    protected static function getClass(): string
    {
        return DocRating::class;
    }
}
