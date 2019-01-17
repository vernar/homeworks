<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galery</title>

     <style>
        .item {
            height: 250px;
            float: left;
            margin: 5px;
            border: 1px black solid;
        }
        .row {
            width: 80%;
            margin: 40px;
        }
    </style>
</head>
<body>
<?php
error_reporting(E_ALL);       // устанавливает уровень отслеживаемых ошибок интерпретатором php
ini_set('display_errors', 1); // дает команду интерпретатору php выводить все отслеживаемые ошибки в браузере


$dbhost = 'localhost';
$dbtable = 'les_galery';
$dbuser = 'root';
$dbpass = 'root';

//check if database is exist, if no we try create it
$pdo = new PDO("mysql:host={$dbhost};", $dbuser, $dbpass);
$stmt = $pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$dbtable}'");
if (!(bool)$stmt->fetchColumn()) {
    echo 'Data base is not exist, try create....' . '</br>';
    $pdo->query(file_get_contents('install.sql'))->execute();
    $stmt = $pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$dbtable}'");
    echo  '</br>';
    echo (bool) $stmt->fetchColumn() ? 'success' : 'un success';
    exit;
}

try {
   $db = new PDO("mysql:host={$dbhost};dbname={$dbtable};charset=utf8", $dbuser, $dbpass);
}catch (PDOException $e) {
   die('Error: '.$e->getMessage().' Code: '.$e->getCode());
}

$images = $db->query("SELECT * FROM files")->fetchAll(PDO::FETCH_ASSOC);
?>

<form enctype="multipart/form-data" action="controller.php?action=add" method="post">
    Upload this file: <input name="files[]" type="file" multiple="multiple" />
    <input name="submit" type="submit" value="Submit File" />
</form>
    <div class="wrap">
        <div class="grid">
                <?php $row = 0; ?>
                <?php foreach ($images as $image ): ?>
                        <div class="item">
                            <img  height="200" src="<?= 'uploads/' . $image['storage_name'] . '.' . $image['extension']?>" alt="" />
                            <form method="post" action="controller.php?action=remove&id=<?=$image['file_id'] ?>">
                                <button type="submit" style="color: red;">X</button>
                            </form>
                        </div>
                <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
