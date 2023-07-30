<?php

namespace App\Services\UserDataServices;

use App\Repository\PaymentMethodRepository;

class PaymentMethodService
{
    private $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function getActivePaymentMethods(): array
    {
        return $this->paymentMethodRepository->findBy(['isActive' => true]);
    }
}