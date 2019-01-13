<?php
error_reporting(E_ALL);       // устанавливает уровень отслеживаемых ошибок интерпретатором php
ini_set('display_errors', 1); // дает команду интерпретатору php выводить все отслеживаемые ошибки в браузере

require_once __DIR__ . '/Dbresource.php';

require_once __DIR__ . '/ProductInterface.php';
require_once __DIR__ . '/Product.php';
require_once __DIR__ . '/Monitor.php';
require_once __DIR__ . '/Headphone.php';
require_once __DIR__ . '/Cart.php';
require_once __DIR__ . '/ProductCollection.php';


$siteUrl = 'http://homeworks.mgnout.com/lessons/lessonx/';

$resource = new Dbresource();
$productCollection = new ProductCollection();
$cart = new Cart($productCollection);


//$productCollection->addProduct('Monitor', 'LG', 'mon1', '10000', 4, '22', Monitor::MN_IPS);
//$productCollection->addProduct('Monitor', 'SAMSUNG', 'mon2', '14000', 5,'26', Monitor::MN_IPS);
//$productCollection->addProduct('Monitor', 'Gorizont', 'mon3', '4000', 8,'22', Monitor::MN_PVA);
//$productCollection->addProduct('Monitor', 'huawey', 'mon4', '5000', 3,'21', Monitor::MN_TN);
//$productCollection->addProduct('Monitor', 'panasonic', 'mon5', '7000', 10,'32', Monitor::MN_SPVA);
//$productCollection->addProduct('Headphone','BLG', 'hph5', '1000',0.12, 22, 0);
//$productCollection->addProduct('Headphone', 'Hugo', 'hph6', '2000',0.08, 22, 1);