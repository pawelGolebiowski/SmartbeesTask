<?php

namespace App\Services\UserDataServices;

use App\Entity\ShippingMethod;
use App\Repository\ShippingMethodRepository;

class ShippingMethodService
{
    private $shippingMethodRepository;

    public function __construct(ShippingMethodRepository $shippingMethodRepository)
    {
        $this->shippingMethodRepository = $shippingMethodRepository;
    }

    public function getActiveShippingMethods(): array
    {
        return $this->shippingMethodRepository->findBy(['isActive' => true]);
    }

    public function findShippingMethodById(?int $shippingMethodId): ?ShippingMethod
    {
        if ($shippingMethodId === null) {
            return null;
        }

        return $this->shippingMethodRepository->find($shippingMethodId);
    }
}