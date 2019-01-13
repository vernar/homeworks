<?php
require_once __DIR__ . '/../model/data.php';

if (isset($_POST['action'])){
    $action = $_POST['action'];
} elseif (isset($_GET['action'])){
    $action = $_GET['action'];
} else {
    $action = '';
}

switch ($action){
    case 'loginaction':
        $login = trim(isset($_POST['login'] ) ? $_POST['login'] : '');
        $password = trim(isset($_POST['password'] ) ? $_POST['password'] : '');
        $result = $connection->checkLoginAdmin($login,$password);
        if (!empty($result)) {
            $_SESSION['name'] = $result['name'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['role'] = $result['role'];
            $_SESSION['message'][] = 'login correct';
        } else {
            $_SESSION['message'][] = 'incorrect login or password';
        }
        header('location: ' . $siteurl . 'admin.php');
        exit;
        break;

    case 'logoutaction':
        session_unset();
        header('location: ' . $siteurl . 'admin.php');
        exit;
        break;

    case 'changecommentstatus':
        if(isset($_POST['status']) && isset($_POST['comment_id'])){
            $newStatus = array_shift($_POST['status']);
            $commentId = $_POST['comment_id'];
            if ($_SESSION['role'] == DBResource::ROLE_MODERATOR && $newStatus == DBResource::COMMENT_APPROVED){
                 $_SESSION['message'][] = 'This action is not available for Moderator user';
                 header('location: ' . $siteurl . 'admin.php');
                 exit;
            }
            $connection->changeCommentStatus($commentId, $newStatus);
        }
        header('location: ' . $siteurl . 'admin.php');
        exit;
        break;
}