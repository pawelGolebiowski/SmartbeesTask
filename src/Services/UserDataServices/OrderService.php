<?php

namespace App\Services\UserDataServices;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\OrderSummary;
use App\Entity\ShippingMethod;
use App\Entity\DiscountCode;

class OrderService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function calculateTotalOrderPriceWithoutDiscount(array $products): float
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->getPrice() * $product->getQuantity();
        }
        return $totalPrice;
    }

    public function calculateTotalOrderPrice(array $products, ?ShippingMethod $shippingMethod, ?DiscountCode $discountCode): float
    {
        $totalPrice = $this->calculateTotalOrderPriceWithoutDiscount($products);

        if ($shippingMethod) {
            $totalPrice += $shippingMethod->getPrice();
        }

        if ($discountCode) {
            $discountPercentage = $discountCode->getPercentage();
            if ($discountPercentage !== null && $discountPercentage > 0 && $discountPercentage <= 100) {
                $totalPrice -= ($totalPrice * $discountPercentage) / 100;
            }
        }

        return $totalPrice;
    }

    public function saveOrder(array $data): void
    {
        $order = new OrderSummary();
        $order->setTotalPrice($data['totalPrice']);
        $order->setComment($data['comment']);
        $order->setPurchasedProducts($data['purchasedProducts']);

        // You may need to set other properties like user, shipping method, etc.

        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }
}
