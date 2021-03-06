<?php

namespace App\GraphQL\Mutation;

use App\Entity\OrderItem;
use App\Entity\ProductItem;
use App\Entity\Orders;
use App\Service\AuthenticatorService;
use App\Service\BasketService;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Argument;
use Redis;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\GraphQL\Input\OrderInput;
use GraphQL\Error\UserError;

class OrderMutation extends AuthMutation
{
    private $authenticatorService;

    public function __construct(
        EntityManager $em,
        Redis $redis,
        ContainerInterface $container,
        AuthenticatorService $authenticatorService,
        BasketService $basketService,
        ObjectManager $manager
    ) {
        $this->manager              = $manager;
        $this->redis                = $redis;
        $this->em                   = $em;
        $this->basketService        = $basketService;
        $this->authenticatorService = $authenticatorService;
        parent::__construct($redis, $container, $authenticatorService);
    }

    public function create(Argument $args)
    {
        $input = new OrderInput($args);

        $basket = $this->basketService
            ->setAuthKey($this->getAuthKey())
            ->getAll();

        $order = new Orders();

        $user  = $this->getUser();
        if ($user) {
            $order->setUserId($user);
            $deliveryId = ($input->pvz_id) ? $input->pvz_id : $input->courier_id;
            if(!$deliveryId) {
                throw new UserError('Необходимо указать хотя бы один метод доставки.');
            }
            $order->setDeliveryId($deliveryId);
            $paymentMethod = $this->em
                ->getRepository('App:PaymentMethod')
                ->find($input->payment_method_id);
            $order->setPaymentMethodId($paymentMethod);
            $address = $this->em
                ->getRepository('App:Address')
                ->find($input->address_id);
            $order->setAddressId($address);
            $order->setComment($input->comment);
        }

        if(!count($basket)) {
            return [
                'id' => null
            ];
        }

        foreach ($basket['products'] as $basketItem) {
            $orderItem = new OrderItem();
            $orderItem->setQty($basketItem['qty']);

            $productItem = $this->em
                ->getRepository(ProductItem::class)
                ->find($basketItem['item_id']);
            if($productItem) {
                $orderItem->setItem($productItem);
            }

            $this->manager->persist($orderItem);
            $this->manager->flush();

            $order->addOrderItem($orderItem);
        }

        $this->manager->persist($order);
        $this->manager->flush();

        $this->basketService
            ->setAuthKey($this->getAuthKey())
            ->delete();
        return [
            'id' => $order->getId()
        ];
    }
}