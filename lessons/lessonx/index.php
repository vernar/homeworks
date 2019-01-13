<?php

include_once 'model/Loader.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'catalog';
switch ($action){
    case 'cart':
        include 'controller/cartcontroller.php';
        break;

    case 'catalog':
        include 'controller/catalogcontroller.php';
        break;
}
