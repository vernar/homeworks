<?php
error_reporting(E_ALL);       // устанавливает уровень отслеживаемых ошибок интерпретатором php
ini_set('display_errors', 1); // дает команду интерпретатору php выводить все отслеживаемые ошибки в браузере

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once __DIR__ . '/mailer/PHPMailer.php';
include_once __DIR__ . '/mailer/Exception.php';
include_once __DIR__ . '/mailer/SMTP.php';

$siteurl = 'http://homeworks.mgnout.com/lessons/lesson10/';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbtable = 'checklogin';

$db = new PDO("mysql:host={$dbhost};dbname={$dbtable};charset=utf8", $dbuser, $dbpass);


$login = isset($_SESSION['login']) ? $_SESSION['login'] : '';
$password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : isset($_GET['action']) ? $_GET['action'] : '';

function sendEmail($sendTo, $sendName, $confirmlink){
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'mgnt001@gmail.com';                 // SMTP username
        $mail->Password = 'mgnt12345';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('mgnt001@gmail.com', 'Mailer');
        $mail->addAddress($sendTo, $sendName);     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Confirm registration';
        $mail->Body    = 'Для подтверждения регстрации, перейдите по <a href="'. $confirmlink .'">ссылке</a>';
        $mail->AltBody = 'Для подтверждения регстрации, перейдите по ссылке: ' . $confirmlink;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}



//if login in
if (!empty($login) ) {
    switch ($action) {
        case 'logoutaction':
             session_unset();
             var_dump($_SESSION);
             header('location: ' . $siteurl . 'index.php');
             exit;
            break;
        default:
            include_once __DIR__ . '/content.php';
    }
} else {
    switch ($action) {
        case 'register':
            include_once __DIR__ . '/register.php';
            break;
        case 'loginaction':
            $login = trim(isset($_POST['login'] ) ? $_POST['login'] : '');
            $password = trim(isset($_POST['password'] ) ? $_POST['password'] : '');
            $result = $db->query("SELECT * FROM user WHERE name = '{$login}' OR mail = '{$login}' AND password = '{$password}'")
                ->fetch(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                $_SESSION['login'] = true;
                $_SESSION['name'] = $result['name'];
                $_SESSION['mail'] = $result['mail'];
                $_SESSION['color'] = $result['color'];
                setcookie('color', $result['color']);
                $_SESSION['message'][] = 'You are login in';
                header('location: ' . $siteurl . 'index.php');
            } else {
                $_SESSION['message'][] = 'Incorrect login or password. Please try again';
                include_once __DIR__ . '/login.php';
            }

            break;
        case 'confirmaction':
            $confirmkey = $_GET['confirmkey'];
            $result = $db->query("SELECT * FROM user WHERE confirm_key = {$confirmkey}")
                ->fetch(PDO::FETCH_ASSOC);
            if ($result['confirm_key'] == $confirmkey) {
                $_SESSION['is_active'] = true;
                $_SESSION['message'][] = 'Registration completed. Please login';
                header('location: ' . $siteurl . 'index.php?action=login');
                exit;
            }
            $_SESSION['message'][] = 'We can not finished registration, please repeat registration process';
            break;
        case 'registeraction':
            $confirmkey = mt_rand(10000,99999);
            $confirmationURL = $siteurl . 'index.php?action=confirmaction&confirmkey=' . $confirmkey;
            $login = isset($_POST['login'] ) ? $_POST['login'] : '';
            $email = isset($_POST['email'] ) ? $_POST['email'] : '';
            $color = isset($_POST['color'] ) ? $_POST['color'] : '';
            $password = isset($_POST['password'] ) ? $_POST['password'] : '';

            if ( !empty($login) &&
                 !empty($email) &&
                 filter_var($email, FILTER_VALIDATE_EMAIL) &&
                 !empty($color) &&
                 !empty($password)
            ){
                sendEmail($email, $login, $confirmationURL );
                $sql = 'INSERT INTO `user` (mail, name, password, color, confirm_key, is_active) VALUES (?, ?, ?, ?, ?, ?)';
                $db->prepare($sql)->execute([$email, $login, $password, $color, $confirmkey, 0 ]);
                $_SESSION['user'] = $login;
                $_SESSION['is_active'] = false;
                $_SESSION['message'][] = 'An email has been sent to your email address. To complete registration, click on the link.';
                header('location: ' . $siteurl . 'index.php?action=login');
                exit;
            } else {
                include_once __DIR__ . '/register.php';
            }
            break;
        case 'login':
            include_once __DIR__ . '/login.php';
            break;
        default:
            header('location: ' . $siteurl . 'index.php?action=login');
            exit;
    }
}
if (isset($_SESSION['message'])){
    foreach ($_SESSION['message'] as $message){
        echo '<p>' . $message . '</p>';
    }
    $_SESSION['message'] = [];
}