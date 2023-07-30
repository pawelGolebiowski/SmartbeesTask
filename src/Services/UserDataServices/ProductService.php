<?php

namespace App\Services\UserDataServices;

use App\Repository\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findAllProducts(): array
    {
        return $this->productRepository->findAllProducts();
    }
}