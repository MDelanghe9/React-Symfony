<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ApiResource(
 *      attributes={
 *          "pagination_enabled"=true,
 *          "pagination_items_per_page"=5
 *      },
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ApiFilter(SearchFilter::class, properties={"brand":"partial", "price", "name":"partial", "popularity"})
 * @ApiFilter(OrderFilter::class)
 * 
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="le nom du produit ne peut etre vide")
     * @Assert\Length(min=5, max=250,
     *      minMessage="le nom du produit doit faire entre 5 et 250 characters",
     *      maxMessage="le nom du produit doit faire entre 5 et 250 characters",
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="le prix du produit ne peut etre vide")
     * @Assert\Type(type="numeric", message="le prix du produit doit etre un nombre entier" )
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $detail;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="le nomnbre de stock du produit ne peut etre vide")
     * @Assert\Type(type="integer", message="le stock du produit doit etre un nombre entier" )
     * 
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=2, max=75,
     *      minMessage="le nom de la marque doit faire entre 2 et 75 characters",
     *      maxMessage="le nom de la marque doit faire entre 2 et 75 characters",
     * )
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="integer", message="la popularite du produit doit etre un nombre entier" )
     * 
     */
    private $popularity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock($stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPopularity(): ?int
    {
        return $this->popularity;
    }

    public function setPopularity( $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

}
