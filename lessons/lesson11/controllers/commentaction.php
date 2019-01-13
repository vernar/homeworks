<?php
require_once __DIR__ . '/../model/data.php';

$connection->addComment(trim($_POST['name']), trim($_POST['comment']));
header('location: ' . $siteurl . 'index.php');
exit;