<?php

class Config
{

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "cloudpizza_db";

    public $conn;
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Veritabanına bağlantı hatası: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
    
}
















?>