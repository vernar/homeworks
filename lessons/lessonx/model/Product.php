<?php

/**
 * Class Product
 *
 * Abstract class Product, base structure
 * for other different products
 *
 * @author Arbuzov Dmitry
 * @version 1.0-beta
 */
abstract class Product implements ProductInterface {

    /**
     * Stock Keeping Unit
     * @var string
     */
    protected $sku;

    /**
     * Name of product
     * @var string
     */
    protected $name;

    /**
     * Product price
     * Adjusted, original Price fo product item
     * without tax and discount
     *
     * @var float
     */
    private $originalPrice;

    /**
     * Product price
     * Price fo product item
     *
     * @var float
     */
    protected $price;

    /**
     * Weight of product
     * @var float
     */
    protected $weight;

    /**
     * Category of product(product type)
     * @var string
     */
    protected $category;

    protected $db;
    protected $productCollection = [];

    public function __construct(string $sku, string $name, float $price, float $weight)
    {

        $this->db = Dbresource::$db;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $this->originalPrice = $price;
        $this->weight = $weight;

    }
    /**
     * Return string with full product info
     * category + name + weight(kg) + price(RUB)
     *
     * @return string
     */
    abstract public function getFullProductInfo();

    /**
     * Return string with product desctiption
     * category + name + [{attributeName} + {attributeValue}...]
     *
     * @return string
     */
    abstract public function getFullProductDescription();


    /**
     * Return current product price with tax and discount
     *
     * @return float
     */
    public function getTotalProductPrice()
    {
        return (float)$this->price;
    }

    /**
     * Return Original product price without tax and discount
     *
     * @return float
     */
    public function getProductPrice()
    {
        return (float)$this->originalPrice;
    }

    /**
     * Apply discount and return discount value
     *
     * @param float $discountPercent
     * @return float
     */
    public function applyDiscount(float $discountPercent)
    {
        $discountAmmount = $this->originalPrice / 100.0 * $discountPercent;
        $this->price = $this->originalPrice - $discountAmmount;
        return (float)$discountAmmount;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return float
     */
    public function getOriginalPrice(): float
    {
        return $this->originalPrice;
    }
}