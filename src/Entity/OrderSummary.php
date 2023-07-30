<?php

namespace App\Entity;

use App\Repository\OrderSummaryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderSummaryRepository::class)]
class OrderSummary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;


    #[ORM\JoinColumn(nullable: false)]
    private $userId;


    #[ORM\JoinColumn(nullable: false)]
    private $shippingMethod;


    #[ORM\JoinColumn(nullable: false)]
    private $paymentMethod;

    // ... dodajemy pole z kodem rabatowym
    #[ORM\Column(type: "string", length: 50, nullable: true)]
    private $discountCode;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?float $totalPrice = null;

    #[ORM\Column(length: 255)]
    private ?string $purchasedProducts = null;

    // Getters and Setters for each property

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?UserData
    {
        return $this->userId;
    }

    public function setUser(int $user): self
    {
        $this->userId = $user;
        return $this;
    }

    public function getShippingMethod(): ?ShippingMethod
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(int $shippingMethod): self
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(int $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getDiscountCode(): ?string
    {
        return $this->discountCode;
    }

    public function setDiscountCode(?string $discountCode): self
    {
        $this->discountCode = $discountCode;
        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getPurchasedProducts(): ?string
    {
        return $this->purchasedProducts;
    }

    public function setPurchasedProducts(string $purchasedProducts): static
    {
        $this->purchasedProducts = $purchasedProducts;

        return $this;
    }
}
