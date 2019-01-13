<?php

/**
 * Class Monitor
 */
class Monitor extends Product
{
    /**
     * Monitor diagonal in inch
     *
     * @var float
     */
    private $diagonal;

    /**
     * contain one of matrix type frome $matrixVariety
     * @var string
     */
    private $matrixType;


    /**
     * List of available matrix type and description
     */
    const MN_TN = 'Twisted Nematic (TN)';
    const MN_IPS = 'In-Plane Switching (IPS)';
    const MN_MVA = 'Multi-domain Vertical Alignment (MVA)';
    const MN_PVA = 'Patterned Vertical Alignment (PVA)';
    const MN_SPVA = 'Super Patterned Vertical Alignment (SPVA)';

    private $matrixVariety = [
        'TN' => self::MN_TN,
        'IPS' => self::MN_IPS,
        'MVA' => self::MN_MVA,
        'PVA' => self::MN_PVA,
        'SPVA' => self::MN_SPVA,
    ];

    /**
     * Monitor constructor.
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param int $diagonal
     * @param string $matrixType
     */
    public function __construct(string $name, string $sku, float $price, float $weight, int $diagonal, string $matrixType)
    {
        $this->category = 'Монитор';
        $this->diagonal = $diagonal;
        $this->matrixType = $matrixType;
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
                $this->diagonal,
                $this->matrixType
            ]);
    }

    /**
     * return diagonal value in inch
     *
     * @return float|int
     */
    public function getDiagonalInch(){
        return $this->diagonal;
    }

    /**
     * return diagonal value in centimeters
     *
     * @return float
     */
    public function getDiagonalCm(){
        return $this->diagonal * 2.54; // inch to cm
    }

    /**
     * Return detailed matrix type
     *
     * @return mixed|string
     */
    public function getDetailedMatrixType(){
        return isset($this->matrixVariety[$this->matrixType]) ?
            $this->matrixVariety[$this->matrixType] :
            $this->matrixType;
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
            'диагональ - ' . $this->diagonal . ' дюймов ' .
            'тип матрицы - ' . $this->getDetailedMatrixType() . PHP_EOL;
    }
}