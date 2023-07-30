<?php

namespace App\Entity;

use App\Repository\ShippingMethodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ShippingMethodRepository::class)]
class ShippingMethod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private $name;

    #[ORM\Column(type: "boolean")]
    private $isActive = true;

    #[ORM\ManyToMany(targetEntity: PaymentMethod::class)]
    private $allowedPaymentMethods;

    #[ORM\Column(type: "float")]
    #[Assert\NotBlank]
    #[Assert\GreaterThan(value: 0)]
    private $price;

    #[ORM\Column(type: "json")]
    private $relatedPaymentMethodsIds = [];

    public function __construct()
    {
        $this->allowedPaymentMethods = new ArrayCollection();
    }

    // Getters and Setters for each property

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return Collection|PaymentMethod[]
     */
    public function getAllowedPaymentMethods(): Collection
    {
        return $this->allowedPaymentMethods;
    }

    public function addAllowedPaymentMethod(PaymentMethod $paymentMethod): self
    {
        if (!$this->allowedPaymentMethods->contains($paymentMethod)) {
            $this->allowedPaymentMethods[] = $paymentMethod;
        }

        return $this;
    }

    public function removeAllowedPaymentMethod(PaymentMethod $paymentMethod): self
    {
        $this->allowedPaymentMethods->removeElement($paymentMethod);

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    public function getRelatedPaymentMethodsIds(): array
    {
        return $this->relatedPaymentMethodsIds;
    }
}

