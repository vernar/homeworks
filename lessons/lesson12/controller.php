<?php
error_reporting(E_ALL);       // устанавливает уровень отслеживаемых ошибок интерпретатором php
ini_set('display_errors', 1); // дает команду интерпретатору php выводить все отслеживаемые ошибки в браузере

$dbhost = 'localhost';
$dbtable = 'les_galery';
$dbuser = 'root';
$dbpass = 'root';

try {
   $db = new PDO("mysql:host={$dbhost};dbname={$dbtable};charset=utf8", $dbuser, $dbpass);
}catch (PDOException $e) {
   die('Error: '.$e->getMessage().' Code: '.$e->getCode());
}

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}

if (isset($_POST['submit']) && isset($_GET['action']) && $_GET['action'] == 'add') {
    try{
        $files = reArrayFiles($_FILES['files']);

        foreach ($files as $file){
            switch ($file['error']) {
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

            if ($file['size'] > 100000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileType = $file['type'];
            $fileErrors = $file['error'];
            $fileSize = $file['size'];

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                    $finfo->file($file['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ),
                    true
                )) {
                throw new RuntimeException('Invalid file type.');
            }

            $originFileName = basename($fileName, '.'. $ext);
            $storegeFileName = date('YmdHis') . '_' . $originFileName;

            if (!move_uploaded_file(
                $file['tmp_name'],
                sprintf('./uploads/%s.%s',
                    $storegeFileName,
                    $ext
                )
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }


            try {
                $sql = 'INSERT INTO `files` (original_name, storage_name, extension) VALUES (?, ?, ?)';
                $db->prepare($sql)->execute([$originFileName, $storegeFileName, $ext ]);
            }catch (PDOException $e) {
                die('Error: '.$e->getMessage().' Code: '.$e->getCode());
            }

            //echo 'File is uploaded successfully.';
        }


    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        try {
            $removeId = (int) $_GET['id'];
            $fileInfo = $db->query("SELECT * FROM files WHERE file_id = '{$removeId}'")->fetch(PDO::FETCH_ASSOC);
            unlink(__DIR__ . '/uploads/' . $fileInfo['storage_name'] . '.' . $fileInfo['extension']);
            $sql = 'DELETE FROM `files` WHERE file_id = ? LIMIT 1';
            $db->prepare($sql)->execute([$removeId ]);
        }catch (PDOException $e) {
            die('Error: '.$e->getMessage().' Code: '.$e->getCode());
        }
    }

}
header('location: index.php');