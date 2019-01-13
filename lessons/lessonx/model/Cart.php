<?php

/**
 * Implement cart functionality
 *
 * Class Cart
 */
class Cart
{
    /**
     * array added to cart products,
     * saved as array where key is product sku and value is product count
     *
     * @var array
     */
    private $productsInCart = [];

    /**
     * collection with all products
     * set in constructor
     *
     * @var array
     */
    private $productsCollection = [];

    /**
     * Cart constructor.
     * @param array $prodcutsCollection
     */

    private $db;

    public function __construct(ProductCollection $productsCollection)
    {
        $this->db = Dbresource::$db;
        $db = $this->db;
        $result = $db->query("SELECT * FROM cart")
            ->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $item){
            $this->productsInCart[$item['product_sku']] = $item['count'];
        }
        $this->productsCollection = $productsCollection->getProductCollection();
    }


    /**
     * @param Product $product
     */
    public function addProductToCart(Product $product)
    {
        $sku = $product->getSku();
        if( isset($this->productsInCart[$sku])){
            $this->productsInCart[$sku] ++;
            $sql = 'UPDATE cart SET count = ? WHERE product_sku = ?';
        } else {
            $this->productsInCart[$sku] = 1;
            $sql = 'INSERT INTO cart (count, product_sku) VALUES (?, ?)';
        }

        $productCount = $this->productsInCart[$sku];
        $this->db->prepare($sql)->execute([$productCount, $sku]);
    }
    
    /**
     * @param Product $product
     */
    public function addProductToCartBySku(string $sku)
    {
        $this->addProductToCart($this->getProductBySku($sku));
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function removeProductFromCart(Product $product)
    {
        $sku = $product->getSku();
        if ( !isset($this->productsInCart[$sku])){
            return false;
        }

        $count = $this->productsInCart[$sku];
        if ($count === 1){
            unset($this->productsInCart[$sku]);
        } elseif ($count > 1){
            $this->productsInCart[$sku] -- ;
        }

        $sql = 'DELETE FROM cart WHERE  product_sku = ?';
        $this->db->prepare($sql)->execute([$sku]);

        return true;
    }

    /**
     * get Product object by product sku string
     *
     * @param string $sku
     * @return Product
     */
    public function getProductBySku(string $sku): Product
    {
        foreach ($this->productsCollection as $product ) {
            if ($sku == $product->getSku()){
                return $product;
            }
        }
        return false;
    }

    /**
     * return product info as string line
     * category + name + '-' + count шт + weight + price
     *
     * @return string
     */
    public function getProductsString()
    {
        $content = '';
        if (count($this->productsInCart) == 0){
            $content = 'Корзина пуста.' . PHP_EOL;
        } else {
            foreach ($this->productsInCart as $sku => $countProducts ) {
                /** @var Product $product */
                $product = $this->getProductBySku($sku);
                if ($product  != false ){
                    $content .= $product->getCategory() . ' ' .
                        $product->getName() . ' - ' .
                        $countProducts . 'шт ' .
                        $product->getWeight() * $countProducts . 'кг ' .
                        $product->getPrice() * $countProducts . 'руб ' . PHP_EOL;
                }
            }
        }

        return $content;
    }
    public function getCartCollection(){
        return $this->productsInCart;
    }

    /**
     * Get total original price from produts in the cart
     * without tax and discount
     *
     * @return float|int
     */
    public function getCartPrice()
    {
        $cartPrice = 0;
        foreach ($this->productsInCart as $sku => $countProducts ) {
            /** @var Product $product */
            $product = $this->getProductBySku($sku);
            if ($product != false) {
                $cartPrice += $product->getOriginalPrice() * $countProducts;
            }
        }
        return $cartPrice;
    }

    /**
     * Get total price from products in the cart
     * with tax and discount
     *
     * @return float|int
     */
    public function getTotalCartPrice()
    {
        $cartTotalPrice = 0;
        foreach ($this->productsInCart as $sku => $countProducts ) {
            /** @var Product $product */
            $product = $this->getProductBySku($sku);
            if ($product != false) {
                $cartTotalPrice += $product->getPrice() * $countProducts;
            }
        }
        return $cartTotalPrice;
    }

    /**
     * return total count products in the cart
     *
     * @return int
     */
    public function getProductCount(): int
    {
        $totalCountProducts = 0;
        foreach ($this->productsInCart as $sku => $countProducts ) {
            $totalCountProducts += $countProducts;
        }
        return $totalCountProducts;
    }

    /**
     * return true, if discount has been applied
     *
     * @return bool
     */
    public function isDiscountApplied():bool
    {
        return $this->getCartPrice() != $this->getTotalCartPrice();
    }

    /**
     * return formated string
     */
    public function getCartHtml():string
    {
        $str = 'Корзина: ' . PHP_EOL .
        $this->getProductsString() .
        'Товара в корзине: ' . $this->getProductCount() . 'шт. ' . PHP_EOL .
        ($this->isDiscountApplied() === true ? 'Итого с учётом скидки: ' : 'Итого: ' ) .
        $this->getTotalCartPrice() . PHP_EOL;

        return $str;
    }

    /**
     *  clear cart
     */
    public function clearCart()
    {
        $this->productsInCart = [];
        $sql = 'DELETE FROM cart ';
        $this->db->prepare($sql)->execute();
    }
}

