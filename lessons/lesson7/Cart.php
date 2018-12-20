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
    public function __construct(array $productsCollection)
    {
        $this->productsCollection = $productsCollection;
    }


    /**
     * @param Product $product
     */
    public function addProductToCart(Product $product)
    {
        if( isset($this->productsInCart[$product->getSku()])){
            $this->productsInCart[$product->getSku()] ++;
        } else {
            $this->productsInCart[$product->getSku()] = 1;
        }

    }

    /**
     * @param Product $product
     * @return bool
     */
    public function removeProductInCart(Product $product)
    {
        if ( !isset($this->productsInCart[$product->getSku()])){
            return false;
        }

        $count = $this->productsInCart[$product->getSku()];
        if ($count === 1){
            unset($this->productsInCart[$product->getSku()]);
        } elseif ($count > 1){
            $this->productsInCart[$product->getSku()] -- ;
        }
        return true;
    }

    /**
     * get Product object by product sku string
     *
     * @param string $sku
     * @return Product
     */
    private function _getProductBySku(string $sku): Product
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
                $product = $this->_getProductBySku($sku);
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
            $product = $this->_getProductBySku($sku);
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
            $product = $this->_getProductBySku($sku);
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
    }
}

