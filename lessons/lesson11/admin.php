<?php
require_once __DIR__ . '/model/data.php';

if (isset($_SESSION['name'])){
    require_once __DIR__ . '/view/dashboard.php' ;
} else {
    require_once __DIR__ . '/view/login.php' ;
}