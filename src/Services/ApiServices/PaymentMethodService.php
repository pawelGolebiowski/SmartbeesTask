<?php

namespace App\Services\ApiServices;

use App\Entity\ShippingMethod;
use App\Repository\PaymentMethodRepository;
use App\Repository\ShippingMethodRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaymentMethodService
{
    private $paymentMethodRepository;
    private $shippingMethodRepository;

    public function __construct(
        PaymentMethodRepository $paymentMethodRepository,
        ShippingMethodRepository $shippingMethodRepository
    ) {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->shippingMethodRepository = $shippingMethodRepository;
    }

    public function getPaymentMethodsForShippingMethod(int $shippingMethodId): JsonResponse
    {
        /** @var ShippingMethod|null $shippingMethod */
        $shippingMethod = $this->shippingMethodRepository->find($shippingMethodId);

        if (!$shippingMethod) {
            return new JsonResponse(['error' => 'Invalid shipping method ID'], JsonResponse::HTTP_NOT_FOUND);
        }

        $relatedPaymentMethodsIds = $shippingMethod->getRelatedPaymentMethodsIds();
        $relatedPaymentMethods = [];

        foreach ($relatedPaymentMethodsIds as $value) {
            foreach ($value as $v) {
                $relatedPaymentMethods[] = $this->paymentMethodRepository->findRelatedPaymentMethodsByIds($v);
            }
        }

        return new JsonResponse(['paymentMethods' => $relatedPaymentMethods]);
    }
}