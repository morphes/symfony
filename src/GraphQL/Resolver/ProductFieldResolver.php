<?php

namespace App\GraphQL\Resolver;

use Doctrine\ORM\EntityManager;
use App\Entity\Product;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Relay\Connection\Paginator;
use Overblog\GraphQLBundle\Relay\Connection\Output\Connection;
use App\Service\TagService;

class ProductFieldResolver implements ResolverInterface
{

    private $em;

    /**
     * ProductResolver constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(
        EntityManager $em,
        TagService $tagService
    ) {
        $this->em = $em;
        $this->tagService = $tagService;
    }

    public function __invoke(ResolveInfo $info, $value, Argument $args)
    {
        $method = $info->fieldName;
        return $this->$method($value, $args);
    }

    /**
     * @param Argument $args
     * @return array
     */
    public function resolve(Argument $args)
    {
        $productUrl = $this->em
            ->getRepository('App:ProductUrl')
            ->findByUrl($args['slug']);

        if ($productUrl) {
            return $productUrl->getEntity();
        }

        return [];
    }

    public function name(Product $product)
    {
        return $product->getName();
    }

    public function url(Product $product)
    {
        if($productUrl = $this->em
            ->getRepository('App:ProductUrl')
            ->findByEntity($product->getId())) {
            return str_replace('//', '/', '/' . $productUrl);
        }
        return '';
    }

    public function id(Product $product)
    {
        return $product->getId();
    }

    public function tags(Product $product)
    {
        return $this->tagService
            ->setEntityType(Product::class)
            ->setEntity($product)
            ->getFilters();
    }

    public function items(Product $product, Argument $args) :Connection
    {
        $items = $product->getProductItems()->toArray();
        $paginator = new Paginator(function () use ($items, $args) {
            return array_slice($items, $args['offset'], $args['limit'] ?? 10);
        });
        return $paginator->auto($args, count($items));
    }

    public function other_fragrance(Product $product)
    {
        return [
            [
                'id' => '1',
                'name' => 'asdf'
            ],
            [
                'id' => '2',
                'name' => 'asdf23'
            ]
        ];
    }

    /**
     * @return array
     */
    public static function getAliases()
    {
        return [
            'resolve' => 'Product'
        ];
    }
}