<?php

namespace App\Controller;

use App\Services\ApiServices\DiscountCodeService;
use App\Services\ApiServices\PaymentMethodService;
use App\Services\ApiServices\PlaceOrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $orderService;
    private $discountCodeService;
    private $paymentMethodService;

    public function __construct(PlaceOrderService $orderService, DiscountCodeService $discountCodeService, PaymentMethodService $paymentMethodService)
    {
        $this->orderService = $orderService;
        $this->discountCodeService = $discountCodeService;
        $this->paymentMethodService = $paymentMethodService;
    }

    /**
     * @Route("/get_payment_methods/{shippingMethodId}", name="get_payment_methods")
     */
    public function getPaymentMethods(int $shippingMethodId): JsonResponse
    {
        $result = $this->paymentMethodService->getPaymentMethodsForShippingMethod($shippingMethodId);
        return $result;
    }

    /**
     * @Route("/check_discount_code/{discountCode}", name="check_discount_code")
     */
    public function checkDiscountCode(string $discountCode): JsonResponse
    {
        $result = $this->discountCodeService->checkDiscountCode($discountCode);
        return new JsonResponse($result);
    }

    /**
     * @Route("/place_order", name="place_order", methods={"GET", "POST"})
     */
    public function placeOrder(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        try {
            $order = $this->orderService->placeOrder($data);
            $orderNumber = $order->getId();
            $responseData = ['orderNumber' => $orderNumber];

            return new JsonResponse($responseData);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
