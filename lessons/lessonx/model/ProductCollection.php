<?php

class ProductCollection
{
    /** @var PDO db */
    protected $db;

    private $productCollection = [];

    public function __construct( )
    {
        $this->db = Dbresource::$db;
        return $this->getProductCollection();
    }

    public function addProduct(string $category, string $name, string $article, float $price, float $weight, string $attribute1, string $attribute2)
    {
        if ($category == 'Monitor') {
            $this->productCollection[$article] = new Monitor($name, $article, $price, $weight, $attribute1, $attribute2);
        } elseif ($category == 'Headphone') {
            $this->productCollection[$article] = new Headphone($name, $article, $price, $weight, $attribute1, $attribute2);
        } else {
            echo ('Category is not exist ' . $category);
            return false;
        }

        $sql = 'INSERT INTO products (category, name, article, price, weight, attribute1, attribute2) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $this->db->prepare($sql)->execute([$category, $name, $article, $price, $weight, $attribute1, $attribute2]);
        return $this->productCollection[$article];
    }

    public function getProductCollection()
    {
        if(count($this->productCollection) < 1){
            $db = $this->db;
            $result = $db->query("SELECT * FROM products")
                ->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $product){
                if ($product['category'] == 'Monitor') {
                    $this->productCollection[$product['article']] = new Monitor($product['name'], $product['article'], $product['price'], $product['weight'], $product['attribute1'], $product['attribute2']);
                } elseif ($product['category'] == 'Headphone') {
                    $this->productCollection[$product['article']] = new Headphone($product['name'], $product['article'], $product['price'], $product['weight'], $product['attribute1'], $product['attribute2']);
                } else {
                    die('Неизвестная категория ' . $product['category']);
                }
            }
        }
        return $this->productCollection;

    }

}