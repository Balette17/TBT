<?php

namespace App\Entity;

use App\Repository\ToysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'ctoyid', targetEntity: Cart::class)]
    private Collection $carts;

    public function __construct()
    {
        $this->carts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTName(); // Assuming getName() is a method in your Toys entity
    }


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

    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): static
    {
        if (!$this->carts->contains($cart)) {
            $this->carts->add($cart);
            $cart->setCtoyid($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): static
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getCtoyid() === $this) {
                $cart->setCtoyid(null);
            }
        }

        return $this;
    }
}
