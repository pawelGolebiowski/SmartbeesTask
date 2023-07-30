<?php

namespace App\Controller;

use App\Form\DiscountCodeFormType;
use App\Form\LoginFormType;
use App\Form\UserDataFormType;
use App\Form\UserOtherAddressDeliveryFormType;
use App\Services\UserDataServices\OrderService;
use App\Services\UserDataServices\DiscountCodeService;
use App\Services\UserDataServices\ProductService;
use App\Services\UserDataServices\ShippingMethodService;
use App\Services\UserDataServices\PaymentMethodService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/", name="order")
     */
    public function order(
        Request $request,
        OrderService $orderService,
        DiscountCodeService $discountCodeService,
        ProductService $productService,
        ShippingMethodService $shippingMethodService
    ): Response {
        $userForm = $this->createForm(UserDataFormType::class);
        $loginForm = $this->createForm(LoginFormType::class);
        $userDeliveryForm = $this->createForm(UserOtherAddressDeliveryFormType::class);
        $userDeliveryForm->handleRequest($request);

        $shippingMethods = $shippingMethodService->getActiveShippingMethods();
        $selectedShippingMethodId = $request->request->get('shippingMethod');
        $selectedShippingMethod = $shippingMethodService->findShippingMethodById($selectedShippingMethodId);

        $discountCodeForm = $this->createForm(DiscountCodeFormType::class);
        if ($request->request->get('addDiscountCodeBtn')) {
            $discountCodeForm = $this->createForm(DiscountCodeFormType::class);
            $discountCodeForm->handleRequest($request);

            if ($discountCodeForm->isSubmitted() && $discountCodeForm->isValid()) {
                $discountCodeData = $discountCodeForm->getData();
                $discountCodeValue = $discountCodeData['kod'];
                $discountCodeService->checkDiscountCode($discountCodeValue);
            }
        }

        $discountCode = $discountCodeService->findActiveDiscountCode();
        $products = $productService->findAllProducts();

        $totalOrderPriceWithoutDiscount = $orderService->calculateTotalOrderPriceWithoutDiscount($products);
        $totalOrderPrice = $orderService->calculateTotalOrderPrice($products, $selectedShippingMethod, $discountCode);

        return $this->render('order/index.html.twig', [
            'userForm' => $userForm->createView(),
            'loginForm' => $loginForm->createView(),
            'shippingMethods' => $shippingMethods,
            'selectedShippingMethod' => $selectedShippingMethod,
            'selectedShippingMethodId' => $selectedShippingMethodId,
            'discountCodeForm' => $discountCodeForm->createView(),
            'discountCode' => $discountCode,
            'products' => $products,
            'totalOrderPriceWithoutDiscount' => $totalOrderPriceWithoutDiscount,
            'totalOrderPrice' => $totalOrderPrice,
            'shippingMethodPrice' => $selectedShippingMethod ? $selectedShippingMethod->getPrice() : 0,
            'userDeliveryForm' => $userDeliveryForm->createView(),
        ]);
    }
}
