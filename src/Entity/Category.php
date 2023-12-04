<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $catid = null;

    #[ORM\Column(length: 50)]
    private ?string $catname = null;

    #[ORM\OneToMany(mappedBy: 'cat', targetEntity: Toys::class)]
    private Collection $toys;

    public function __construct()
    {
        $this->toys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatid(): ?string
    {
        return $this->catid;
    }

    public function setCatid(string $catid): static
    {
        $this->catid = $catid;

        return $this;
    }

    public function getCatname(): ?string
    {
        return $this->catname;
    }

    public function setCatname(string $catname): static
    {
        $this->catname = $catname;

        return $this;
    }

    /**
     * @return Collection<int, Toys>
     */
    public function getToys(): Collection
    {
        return $this->toys;
    }

    public function addToy(Toys $toy): static
    {
        if (!$this->toys->contains($toy)) {
            $this->toys->add($toy);
            $toy->setCat($this);
        }

        return $this;
    }

    public function removeToy(Toys $toy): static
    {
        if ($this->toys->removeElement($toy)) {
            // set the owning side to null (unless already changed)
            if ($toy->getCat() === $this) {
                $toy->setCat(null);
            }
        }

        return $this;
    }
}
