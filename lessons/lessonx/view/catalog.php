<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalog</title>

    <style>
        .item {
            width: 32%;
            height: 150px;
            float: left;
            margin: 5px;
            border: 1px black solid;
        }
        .row {
            width: 80%;
            margin: 40px;
        }
    </style>
    <?php /** @var  ProductCollection $productCollection */ ?>
    <?php $products = $productCollection->getProductCollection(); ?>
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

<div class="wrap">
    <div class="grid">

            <?php $row = 0; ?>
            <?php /** @var Product $product */ ?>
            <?php foreach ($products as $product ): ?>
                    <div class="item">
                        <?= $product->getCategory() ?>
                        <?= $product->getName() ?>
                        <p><?= $product->getFullProductDescription() ?></p>
                        <p>Цена продукта: <?= $product->getPrice() ?></p>
                        <form method="post" action="<?=$siteUrl?>controller/cartcontroller.php?action=add&sku=<?= $product->getSku() ?>">
                            <button type="submit" >Добавить в корзину</button>
                        </form>
                    </div>
            <?php endforeach; ?>

    </div>
</div>

</body>
</html>