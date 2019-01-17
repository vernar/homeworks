<?php

class DBResource
{
     protected $db;
     private $dbEngine;

     private $dbhost;
     private $dbuser;
     private $dbpass;
     private $dbtable;

    const DB_PDO = 0;
    const DB_Mysqli = 1;

    const COMMENT_NEW = 0;
    const COMMENT_APPROVED = 1;
    const COMMENT_DECLINED = 2;

    const ROLE_ADMIN = 0;
    const ROLE_MODERATOR = 1;

    public function __construct(string $dbEngine, string $dbtable = 'portfolio', string $dbhost = 'localhost', string $dbuser = 'root', string $dbpass = 'root' )
    {
        if (isset($this->db) ){
            return $this->db;
        }
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbtable = $dbtable;

        //check if database is exist, if no we try create it
        $pdo = new PDO("mysql:host={$dbhost};", $dbuser, $dbpass);
        $stmt = $pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$dbtable}'");
        if (!(bool)$stmt->fetchColumn()) {
            echo 'Data base is not exist, try create....' . '</br>';
            $pdo->query(file_get_contents(__DIR__ . '/install.sql'))->execute();
            $stmt = $pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$dbtable}'");
            echo  '</br>';
            echo (bool) $stmt->fetchColumn() ? 'success' : 'un success';
            exit;
        }

        if ($dbEngine == self::DB_PDO){
            $this->db = new PDO("mysql:host={$dbhost};dbname={$dbtable};charset=utf8", $dbuser, $dbpass);
            $this->dbEngine = self::DB_PDO;
        } elseif ($dbEngine == self::DB_Mysqli){
            $this->db = new mysqli($dbhost, $dbuser, $dbpass, $dbtable);
            $this->dbEngine = self::DB_Mysqli;
            if (!$this->db) {
               printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
               exit;
            }
            $this->db->set_charset("utf8");

        } else {
            die ('argument is incorrect');
        }
        return $this->db;
    }

    public function getAllComments(){
         if ($this->dbEngine === self::DB_PDO ) {
             /** @var PDO $db */
             $db = $this->db;
             $result = $db->query("SELECT * FROM `comments` ")
                ->fetchAll(PDO::FETCH_ASSOC);
         }
        if ($this->dbEngine === self::DB_Mysqli) {
            /** @var mysqli $db */
            $db = $this->db;
            $result = $db->query("SELECT * FROM `comments` ")
                ->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function getComments(){
         if ($this->dbEngine === self::DB_PDO ) {
             /** @var PDO $db */
             $db = $this->db;
             $result = $db->query("SELECT * FROM `comments` WHERE status = '" . self::COMMENT_APPROVED . "'")
                ->fetchAll(PDO::FETCH_ASSOC);
         }
        if ($this->dbEngine === self::DB_Mysqli) {
            /** @var mysqli $db */
            $db = $this->db;
            $result = $db->query("SELECT * FROM `comments`  WHERE status = '" . self::COMMENT_APPROVED . "'")
                ->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function addComment($name, $comment){
        if (strpos($comment, "редиска")){
            return;
        }
        $name = htmlspecialchars($name);
        $comment = htmlspecialchars($comment);

        $sql = 'INSERT INTO comments (name, comment, date_submit) VALUES (?, ?, NOW())';
        $this->db->prepare($sql)->execute([$name, $comment]);
    }

    public function checkLoginAdmin($login, $password){
        return $this->db->query("SELECT * FROM users WHERE name = '{$login}'  AND password = '{$password}'")
                ->fetch(PDO::FETCH_ASSOC);
    }

    public function changeCommentStatus($id, $status){
        $sql = 'UPDATE comments SET status = ? WHERE comment_id = ?';
        $this->db->prepare($sql)->execute([$status, $id]);
    }

    public function getDataAsArrayById($id = 1)
    {
        if ($this->dbEngine === self::DB_PDO ){
            /** @var PDO $db */
            $db = $this->db;
            $result = $db->query("SELECT * FROM `person` WHERE `person_id` = {$id}")
                ->fetch(PDO::FETCH_ASSOC);

            $result['education'] = $db->query("SELECT * FROM `education` WHERE `person_id` = {$id}")
                ->fetchAll(PDO::FETCH_ASSOC);

            $result['language'] = $db->query("SELECT * FROM `language` WHERE `person_id` = {$id}")
                ->fetchAll(PDO::FETCH_ASSOC);

            $result['interests'] = $db->query("SELECT * FROM `interests` WHERE `person_id` = {$id}")
                ->fetchAll(PDO::FETCH_ASSOC);

            $result['experiences']= $db->query("SELECT * FROM `expiriences` WHERE `person_id` = {$id}")
                ->fetchAll(PDO::FETCH_ASSOC);

            $result['projects'] = $db->query("SELECT * FROM `projects` WHERE `person_id` = {$id}")
                ->fetchAll(PDO::FETCH_ASSOC);

            $result['skills'] = $db->query("SELECT * FROM `skills` WHERE `person_id` = {$id}")
                ->fetchAll(PDO::FETCH_ASSOC);
        }
        if ($this->dbEngine === self::DB_Mysqli){
                 /** @var mysqli $db */
            $db = $this->db;
            $result = $db->query("SELECT * FROM `person` WHERE `person_id` = {$id}")
                ->fetch_assoc();

            $result['education'] = $db->query("SELECT * FROM `education` WHERE `person_id` = {$id}")
                ->fetch_all(MYSQLI_ASSOC);

            $result['language'] = $db->query("SELECT * FROM `language` WHERE `person_id` = {$id}")
                ->fetch_all(MYSQLI_ASSOC);

            $result['interests'] = $db->query("SELECT * FROM `interests` WHERE `person_id` = {$id}")
                ->fetch_all(MYSQLI_ASSOC);

            $result['experiences']= $db->query("SELECT * FROM `expiriences` WHERE `person_id` = {$id}")
                ->fetch_all(MYSQLI_ASSOC);

            $result['projects'] = $db->query("SELECT * FROM `projects` WHERE `person_id` = {$id}")
                ->fetch_all(MYSQLI_ASSOC);

            $result['skills'] = $db->query("SELECT * FROM `skills` WHERE `person_id` = {$id}")
                ->fetch_all(MYSQLI_ASSOC);
        }

        return $result;
    }
}