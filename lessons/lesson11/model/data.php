<?php
error_reporting(E_ALL);       // устанавливает уровень отслеживаемых ошибок интерпретатором php
ini_set('display_errors', 1); // дает команду интерпретатору php выводить все отслеживаемые ошибки в браузере

session_start();



$siteurl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/lessons/lesson11/';

require __DIR__ . '/DBResource.php';

if(isset($_GET['mysqli'])){
    $engine = DBResource::DB_Mysqli;
} else {
    $engine = DBResource::DB_PDO;
}
$connection = new DBResource($engine);
$result  = $connection->getDataAsArrayById();
return $result;