<?php

namespace App\Services\ApiServices;

use App\Entity\OrderSummary;
use Doctrine\ORM\EntityManagerInterface;

class PlaceOrderService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function placeOrder(array $data): OrderSummary
    {
        if (!isset($data['comment'], $data['totalPrice'], $data['purchasedProducts'])) {
            throw new \InvalidArgumentException('Invalid request data');
        }

        $totalPrice = $data['totalPrice'];
        $comment = $data['comment'];
        $purchasedProducts = $data['purchasedProducts'];

        $order = new OrderSummary();
        $order->setTotalPrice($totalPrice);
        $order->setComment($comment);
        $order->setPurchasedProducts($purchasedProducts);

        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return $order;
    }
}