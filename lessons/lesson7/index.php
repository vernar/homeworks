<?php

require_once 'ProductInterface.php';
require_once 'Product.php';
require_once 'Monitor.php';
require_once 'Headphone.php';
require_once 'Cart.php';

$products[] = new Monitor('mon1', 'LG', '10000', 4, '22', Monitor::MN_IPS);
$products[] = new Monitor('mon2', 'SAMSUNG', '14000', 5,'26', Monitor::MN_IPS);
$products[] = new Monitor('mon3', 'Gorizont', '4000', 8,'22', Monitor::MN_PVA);
$products[] = new Monitor('mon4', 'huawey', '5000', 3,'21', Monitor::MN_TN);
$products[] = new Monitor('mon5', 'panasonic', '7000', 10,'32', Monitor::MN_SPVA);

$products[] = new Headphone('hph5', 'BLG', '1000',0.12, 22);
$products[] = new Headphone('hph6', 'Hugo', '2000',0.08, 22, true);

//applied discount
$products[0]->applyDiscount(20);

foreach ($products as $product){
   echo $product->getFullProductInfo();
}
echo PHP_EOL;
foreach ($products as $product){
    echo $product->getFullProductDescription();
}

/**
 * additional task
 */

//create cart object
$cart = new Cart($products);

//add all products to cart object
foreach ($products as $product){
    $cart->addProductToCart($product);
}

// add more produts to cart
$cart->addProductToCart($products[3]);
$cart->addProductToCart($products[3]);
$cart->addProductToCart($products[3]);
$cart->addProductToCart($products[4]);
$cart->addProductToCart($products[4]);


//output cart
echo PHP_EOL . '//----------------------------------------//' . PHP_EOL;

echo $cart->getCartHtml();

echo PHP_EOL . '//----------------------------------------//' . PHP_EOL;
$cart->clearCart();
echo $cart->getCartHtml();
