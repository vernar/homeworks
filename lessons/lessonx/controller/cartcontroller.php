<?php

require_once __DIR__ . '/../model/Loader.php';


$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action){
    case 'add':
        $cart->addProductToCartBySku($_GET['sku']);
        header("Location: {$siteUrl}index.php?action=catalog");
        break;
    case 'del':
        $cart->removeProductFromCart($cart->getProductBySku($_GET['sku']));
        header("Location: {$siteUrl}index.php?action=cart");

        break;
    case 'clear':
        $cart->clearCart();
        header("Location: {$siteUrl}index.php?action=catalog");
        break;
    default:
        include __DIR__ . '/../view/cart.php';
}


