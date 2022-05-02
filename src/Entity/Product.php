<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** A product. */
#[ORM\Entity]
#[ApiResource]
class Product
{
    /** The id of this product. */
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    /** The title of this product. */
    #[ORM\Column]
    public string $name = '';

    /** The description of this product. */
    #[ORM\Column]
    public string $description = '';

    /** The size of this product. */
    #[ORM\Column]
    public string $size = '';

    /** The key words of this product. */
    #[ORM\Column]
    public array $keyWords = [];

    /** @var Category */
    #[ORM\ManyToOne(inversedBy: 'products')]
    public Category $category;

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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    /**
     * @return array
     */
    public function getKeyWords(): array
    {
        return $this->keyWords;
    }

    /**
     * @param array $keyWords
     */
    public function setKeyWords(array $keyWords): void
    {
        $this->keyWords = $keyWords;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}