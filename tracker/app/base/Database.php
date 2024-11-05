<?php

namespace App\Base;
use PDO;
use PDOException;
class Database extends PDO
{

    private $host = 'localhost';
    private $db_name = 'backend';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct($config = null)
    {
        if($config != null){
            $this->host = $config['db']['host'];
            $this->db_name = $config['db']['dbname'];
            $this->username = $config['db']['username'];
            $this->password = $config['db']['password'];
            $this->port = $config['db']['port'];
            $this->charset = $config['db']['charset'];
            $this->database_type = $config['db']['database_type'];
        }
        $this->conn = null;
        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        }catch(PDOException $e){
            echo 'Connection Error: ' . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

}