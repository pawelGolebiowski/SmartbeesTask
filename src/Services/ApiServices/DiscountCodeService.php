<?php

namespace App\Services\ApiServices;

use App\Repository\DiscountCodeRepository;

class DiscountCodeService
{
    private $discountCodeRepository;

    public function __construct(DiscountCodeRepository $discountCodeRepository)
    {
        $this->discountCodeRepository = $discountCodeRepository;
    }

    public function checkDiscountCode(string $discountCode): array
    {
        $discountCodeObject = $this->discountCodeRepository->findOneBy(['code' => $discountCode]);

        if (!$discountCodeObject) {
            return ['message' => 'Kod rabatowy nie istnieje.', 'isActive' => false];
        }

        $isActive = $discountCodeObject->getIsActive();
        $discountPercentage = $isActive ? $discountCodeObject->getPercentage() : 0;

        return [
            'message' => 'Kod rabatowy ' . $discountCode . ' jest ' . ($isActive ? 'aktywny' : 'nieaktywny') . '.',
            'isActive' => $isActive,
            'discountPercentage' => $discountPercentage,
        ];
    }
}