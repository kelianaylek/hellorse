<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** A review of a book. */
#[ORM\Entity]
#[ApiResource]
class Category
{
    /** The id of this category. */
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    /** The body of the category. */
    #[ORM\Column]
    public string $name = '';

    /** @var ArrayCollection|Product */
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class, cascade: ['persist', 'remove'])]
    public ArrayCollection|Product $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Product|ArrayCollection
     */
    public function getProducts(): ArrayCollection|Product
    {
        return $this->products;
    }

    /**
     * @param Product|ArrayCollection $products
     */
    public function setProducts(ArrayCollection|Product $products): void
    {
        $this->products = $products;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}