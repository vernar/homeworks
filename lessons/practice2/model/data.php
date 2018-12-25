<?php
require __DIR__ . '/DBResource.php';

if(isset($_GET['mysqli'])){
    $engine = DBResource::DB_Mysqli;
} else {
    $engine = DBResource::DB_PDO;
}
var_dump($engine);
$connection = new DBResource($engine);
$result  = $connection->getDataAsArrayById();
return $result;