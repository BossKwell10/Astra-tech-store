<?php

namespace App\Entity;

use App\Repository\CampagnyRepository;
use App\Utils\Horodatage;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampagnyRepository::class)]
#[ORM\Table(name: 'campagny')]
#[ORM\HasLifecycleCallbacks]
class Campagny
{
    use Horodatage;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $sector = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $services = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $whathsapp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ticktok = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(string $sector): static
    {
        $this->sector = $sector;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    public function getPostal(): ?string
    {
        return $this->postal;
    }

    public function setPostal(?string $postal): static
    {
        $this->postal = $postal;

        return $this;
    }

    public function getServices(): ?string
    {
        return $this->services;
    }

    public function setServices(?string $services): static
    {
        $this->services = $services;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getWhathsapp(): ?string
    {
        return $this->whathsapp;
    }

    public function setWhathsapp(?string $whathsapp): static
    {
        $this->whathsapp = $whathsapp;

        return $this;
    }

    public function getTicktok(): ?string
    {
        return $this->ticktok;
    }

    public function setTicktok(?string $ticktok): static
    {
        $this->ticktok = $ticktok;

        return $this;
    }
}
