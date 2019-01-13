<?php

/**
 * Class Headphone
 */
class Headphone extends Product
{
    /**
     * Contain max volume value in dBl
     *
     * @var int
     */
    private $maxVolume;

    /**
     * Contain true if product wireless
     *
     * @var bool
     */
    private $isWireless;

    /**
     * Headphone constructor.
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param float $weight
     * @param int $maxVolume
     * @param bool $isWireless
     */
    public function __construct(string $name, string $sku, float $price, float $weight, int $maxVolume, bool $isWireless = false)
    {
        $this->category = 'Headphone';
        $this->maxVolume = $maxVolume;
        $this->isWireless = $isWireless;

        parent::__construct($sku, $name, $price, $weight);

        $this->productCollection[$sku] = $this;
 }

    public function writeMeToDb(){
        $sql = 'INSERT INTO products (category, name, article, price, weight, attribute1, attribute2) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $this->db->prepare($sql)
            ->execute([
                $this->category,
                $this->name,
                $this->sku,
                $this->price,
                $this->weight,
                $this->maxVolume,
                $this->isWireless
            ]);
    }


    /**
     * Return maximal volume value in dBl
     *
     * @return int
     */
    public function getMaxVolume()
    {
        return $this->maxVolume;
    }

    /**
     * Return true if headphones if wireless
     *
     * @return bool
     */
    public function isWireless()
    {
        return (bool)$this->isWireless;
    }

    /**
     * Return string with full product info
     * category + name + weight(kg) + price(RUB)
     *
     * @return string
     */
    public function getFullProductInfo()
    {
        return $this->category . ' ' .
            $this->name . ', ' .
            $this->weight . 'кг, ' .
            $this->price .' руб.' . PHP_EOL;
    }

    /**
     * Return string with product desctiption
     * category + name + [{attributeName} + {attributeValue}...]
     *
     * @return string
     */
    public function getFullProductDescription()
    {
        return $this->category . ' ' .
            $this->name . ', ' .
            'максимальная громкость - ' . $this->maxVolume . ' dBl ' .
            'безпроводные - ' . ($this->isWireless == true ? 'да' : 'нет') . PHP_EOL;
    }

}