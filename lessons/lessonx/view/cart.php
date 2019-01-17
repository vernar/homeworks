<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <style>
        div.cart {
            border: 3px solid #000000;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }
        .divTable.cart .divTableCell, .divTable.cart .divTableHead {
            border: 1px solid #000000;
            padding: 5px 4px;
        }
        .divTable.cart .divTableBody .divTableCell {
            font-size: 13px;
        }
        .cart .tableFootStyle {
            font-size: 14px;
            font-weight: bold;
            color: #000000;
            border-top: 3px solid #000000;
        }
        .cart .tableFootStyle {
            font-size: 14px;
        }
        /* DivTable.com */
        .divTable{ display: table; }
        .divTableRow { display: table-row; }
        .divTableHeading { display: table-header-group;}
        .divTableCell, .divTableHead { display: table-cell;}
        .divTableHeading { display: table-header-group;}
        .divTableFoot { display: table-footer-group;}
        .divTableBody { display: table-row-group;}
    </style>
</head>
<header>
    <div class="menu">
        <span>
            <a href="<?=$siteUrl . 'index.php?action=catalog'?>">Catalog</a>
        </span>
        <span>
            <a href="<?=$siteUrl . 'index.php?action=cart'?>">Cart</a>
            <span> (<?= $cart->getProductCount(); ?>)</span>
        </span>
    </div>
</header>
<body>
<?php /** @var ../model/Cart $cart */?>
<?php $cartCollection = $cart->getCartCollection() ?>
<div class="divTable cart">
    <div class="divTableBody">
        <?php foreach ($cartCollection as $sku => $count): ?>
        <?php $product = $cart->getProductBySku($sku) ?>
        <div class="divTableRow">

                <div class="divTableCell"><?= $product->getCategory() . $product->getName()?></div>
                <div class="divTableCell"><?= $product->getWeight() ?></div>
                <div class="divTableCell"><?= $product->getPrice() ?></div>
                <div class="divTableCell"><?= $count ?></div>
                <div class="divTableCell"><a href="<?= $siteUrl . 'controller/cartcontroller.php?action=del&sku=' . $product->getSku()?>">delete</a> </div>
        </div>
        <?php endforeach;?>

    </div>
    <div class="divTableFoot tableFootStyle">
        <div class="divTableRow">
            <div class="divTableCell">Total</div>
            <div class="divTableCell"></div>
            <div class="divTableCell"><?= $cart->getTotalCartPrice() ?></div>
            <div class="divTableCell"><?= $cart->getProductCount() ?></div>
            <div class="divTableCell"><a href="<?= $siteUrl . '/controller/cartcontroller.php?action=clear'?>">Flush cart</a> </div>
        </div>
    </div>
</div>
</body>
</html>