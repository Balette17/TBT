<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: Toys::class)]
    private Collection $cartid;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $cartItem = null;

    public function __construct()
    {
        $this->cartid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Toys>
     */
    public function getCartid(): Collection
    {
        return $this->cartid;
    }

    public function addCartid(Toys $cartid): static
    {
        if (!$this->cartid->contains($cartid)) {
            $this->cartid->add($cartid);
            $cartid->setCart($this);
        }

        return $this;
    }

    public function removeCartid(Toys $cartid): static
    {
        if ($this->cartid->removeElement($cartid)) {
            // set the owning side to null (unless already changed)
            if ($cartid->getCart() === $this) {
                $cartid->setCart(null);
            }
        }

        return $this;
    }

    public function getCartItem(): ?User
    {
        return $this->cartItem;
    }

    public function setCartItem(?User $cartItem): static
    {
        $this->cartItem = $cartItem;

        return $this;
    }
}
