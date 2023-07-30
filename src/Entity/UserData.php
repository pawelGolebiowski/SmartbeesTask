<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class UserData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private $login;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 255)]
    private $password;

    #[Assert\NotBlank]
    #[Assert\Expression(
        "this.getPassword() === this.getConfirmedPassword()",
        message: "Hasła muszą być identyczne."
    )]
    private $confirmedPassword;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private $firstName;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private $lastName;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private $country;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private $address;

    #[ORM\Column(type: "string", length: 10)]
    #[Assert\NotBlank]
    private $postalCode;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private $city;

    #[ORM\Column(type: "string", length: 20)]
    #[Assert\NotBlank]
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getConfirmedPassword(): ?string
    {
        return $this->confirmedPassword;
    }

    public function setConfirmedPassword(string $confirmedPassword): self
    {
        $this->confirmedPassword = $confirmedPassword;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }
}