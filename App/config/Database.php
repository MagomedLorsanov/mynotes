<?php
namespace App\config;
use PDO;
require_once __DIR__ .'./config.php';
class Database
{
    private $host = DB_HOST;
    private $username = DB_USER;
    private $dbname = DB_NAME;
    private $password = DB_PASSWORD;


    public function  __construct()
    {
    }

    protected function connect()
    {
        $options = array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $dsn = "mysql:host=$this->host; dbname=$this->dbname";
            $pdo  = new PDO($dsn, $this->username, $this->password, $options);
            // $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            // $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $error) {
           die('Connection failed: ' . $error->getMessage());
        }
    }
}
