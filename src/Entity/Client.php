<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Please enter a company name')]
    private ?string $companyName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Please enter a firstname')]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Please enter a lastname')]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(message: 'The email {{ value }} is not a valid email.')]
    #[Assert\NotBlank(message: 'Please enter an email')]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Regex(pattern: '/^\+?[0-9]{0,15}$/')]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): static
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): static
    {
        $this->users = $users;

        return $this;
    }
}
