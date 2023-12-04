<?php

namespace App\Entity;

use App\Repository\ToysRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToysRepository::class)]
class Toys
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $tname = null;

    #[ORM\Column(length: 255)]
    private ?string $tdesc = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $tquan = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\ManyToOne(inversedBy: 'toys')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $cat = null;

    #[ORM\ManyToOne(inversedBy: 'cartid')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cart $cart = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTname(): ?string
    {
        return $this->tname;
    }

    public function setTname(string $tname): static
    {
        $this->tname = $tname;

        return $this;
    }

    public function getTdesc(): ?string
    {
        return $this->tdesc;
    }

    public function setTdesc(string $tdesc): static
    {
        $this->tdesc = $tdesc;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getTquan(): ?int
    {
        return $this->tquan;
    }

    public function setTquan(int $tquan): static
    {
        $this->tquan = $tquan;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getCat(): ?Category
    {
        return $this->cat;
    }

    public function setCat(?Category $cat): static
    {
        $this->cat = $cat;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): static
    {
        $this->cart = $cart;

        return $this;
    }
}
