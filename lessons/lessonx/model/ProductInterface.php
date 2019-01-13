<?php

/**
 * Interface ProductInterface
 *
 * interface for product classes
 */
interface ProductInterface {

    /**
     * Get total price
     *
     * @return int
     */
    public function getTotalProductPrice();


    /**
     * Get price without NDS
     *
     * @return int
     */
    public function getProductPrice();


    /**
     * Apply discount to product
     *
     * @param float $discount
     * @return float
     */
    public function applyDiscount(float $discountPercent);
}