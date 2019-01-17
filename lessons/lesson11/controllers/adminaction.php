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
    case 'changeimage':
            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
            if ($_FILES['file']['size'] > 100000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                    $finfo->file($_FILES['file']['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png'
                    ),
                    true
                )) {
                throw new RuntimeException('Invalid file type.');
            }
            //unlink(__DIR__ . '/../assets/images/profile.jpg');
            if (!move_uploaded_file(
                $_FILES['file']['tmp_name'], __DIR__ . '/../assets/images/profile.jpg')) {
                throw new RuntimeException('Failed to move uploaded file.');
            }
            header('location: ' . $siteurl . 'admin.php');
            exit;
        break;
    case 'deleteimage':
        unlink(__DIR__ . '/../assets/images/profile.jpg');
        header('location: ' . $siteurl . 'admin.php');
        exit;
        break;

}