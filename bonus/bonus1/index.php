
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
        #menu {
            width: 100%;
        }
        .menuitem {
            float: left;
            height: 50px;
            text-align: center;
            border: 1px black solid;
            margin: 10px;
            vertical-align: middle;
        }
        .menuitem:hover {
            background: #D0E4F5;
        }
        .active {
            background: #AAAAAA;
        }

        .menuitem a{
            line-height: 3;
        }

        #wrap{
            float: left;
        }
        span.liketext {
            font-weight: bold;
        }
        #footer-content{
            float: left;
            width: 100%;
        }
    </style>
</head>
<header>
    <?php include 'ldata.php' ?>
    <?php include 'header.php' ?>
    <?php /** @see ldata.php */ ?>
    <?php $cur = $ldata[$_GET['p']] ?>
</header>
<body>
    <div id="wrap">
        <div id="title">
            <h2><?= $cur['name'] ?></h2>
        </div>
        <div id="likes">
            <span class="liketext">Что понравилось:</span>
            <?php foreach ($cur['likes'] as $val): ?>
                <li><?=$val ?> </li>
            <?php endforeach; ?>
        </div>
        <div id="unlikes">
            <span class="liketext">Что не понравилось:</span>
            <?php foreach ($cur['unlikes'] as $val): ?>
                <li><?=$val ?> </li>
            <?php endforeach; ?>
        </div>
        <div id="content">
            <h4><?= $cur['description'] ?></h4>
            <?php include $cur['file'] ?>
        </div>
        <div id="sourcecod">
            <?php if ($cur['outputsource'] === true): ?>
                <h4>Source code: </h4>
                <?php highlight_file($cur['file']);  ?>
            <?php endif; ?>
        </div>
    </div>
</body>
<footer>
    <?php include 'footer.php' ?>
</footer>
</html>