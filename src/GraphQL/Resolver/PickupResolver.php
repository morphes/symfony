<?php
namespace App\GraphQL\Resolver;

use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PickupResolver implements ResolverInterface, AliasedInterface
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function resolve()
    {
        $pickups = $this->em->getRepository('App:Pickup')->findAll();
        return [
            'data' => $pickups
        ];
    }

    public static function getAliases()
    {
        return [
            'resolve' => 'Pickups'
        ];
    }
}