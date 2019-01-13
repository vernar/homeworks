<?php

class Dbresource
{
    static $db;

    public function __construct( string $dbtable = 'mystore', string $dbhost = 'localhost', string $dbuser = 'root', string $dbpass = 'root' )
    {
        self::$db = new PDO("mysql:host={$dbhost};dbname={$dbtable};charset=utf8", $dbuser, $dbpass);
    }

    public function getResource()
    {
        return self::$db;
    }
}