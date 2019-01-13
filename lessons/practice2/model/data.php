<?php
require __DIR__ . '/DBResource.php';

if(isset($_GET['mysqli'])){
    $engine = productCollection::DB_Mysqli;
} else {
    $engine = productCollection::DB_PDO;
}
$connection = new productCollection($engine);
$result  = $connection->getDataAsArrayById();
return $result;