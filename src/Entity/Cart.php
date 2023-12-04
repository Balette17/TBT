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


    #[ORM\ManyToOne(inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $cartItem = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Toys $ctoyid = null;

    #[ORM\Column]
    private ?int $cquantity = null;

    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCtoyid(): ?Toys
    {
        return $this->ctoyid;
    }

    public function setCtoyid(?Toys $ctoyid): static
    {
        $this->ctoyid = $ctoyid;

        return $this;
    }

    public function getCquantity(): ?int
    {
        return $this->cquantity;
    }

    public function setCquantity(int $cquantity): static
    {
        $this->cquantity = $cquantity;

        return $this;
    }

 
}
