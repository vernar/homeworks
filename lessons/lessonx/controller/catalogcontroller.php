<?php
require_once __DIR__ . '/../model/Loader.php';


$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action){
    case 'filter':
        break;
    default:
        include __DIR__ . '/../view/catalog.php';
}


