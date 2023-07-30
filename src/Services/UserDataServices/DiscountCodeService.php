<?php

namespace App\Services\UserDataServices;

use App\Entity\DiscountCode;
use App\Repository\DiscountCodeRepository;

class DiscountCodeService
{
    private $discountCodeRepository;

    public function __construct(DiscountCodeRepository $discountCodeRepository)
    {
        $this->discountCodeRepository = $discountCodeRepository;
    }

    public function checkDiscountCode(string $discountCodeValue): void
    {
        $discountCode = $this->discountCodeRepository->findOneBy(['kod' => $discountCodeValue]);

        if (!$discountCode) {
            throw new \InvalidArgumentException('Invalid discount code.');
        }

        if (!$discountCode->getIsActive()) {
            throw new \InvalidArgumentException('The discount code is inactive.');
        }
    }

    public function findActiveDiscountCode(): ?DiscountCode
    {
        return $this->discountCodeRepository->findActiveCode();
    }
}