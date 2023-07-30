<?php

namespace App\Entity;

use App\Repository\PaymentMethodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PaymentMethodRepository::class)]
class PaymentMethod
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

    #[ORM\ManyToMany(targetEntity: ShippingMethod::class, inversedBy: "allowedPaymentMethods")]
    private $allowedShippingMethods;

    public function __construct()
    {
        $this->allowedShippingMethods = new ArrayCollection();
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
     * @return Collection|ShippingMethod[]
     */
    public function getAllowedShippingMethods(): Collection
    {
        return $this->allowedShippingMethods;
    }

    public function addAllowedShippingMethod(ShippingMethod $shippingMethod): self
    {
        if (!$this->allowedShippingMethods->contains($shippingMethod)) {
            $this->allowedShippingMethods[] = $shippingMethod;
        }

        return $this;
    }

    public function removeAllowedShippingMethod(ShippingMethod $shippingMethod): self
    {
        $this->allowedShippingMethods->removeElement($shippingMethod);

        return $this;
    }
}

