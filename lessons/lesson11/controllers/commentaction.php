<?php
require_once __DIR__ . '/../model/data.php';

$connection->addComment(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['comment']));
header('location: ' . $siteurl . 'index.php');
exit;