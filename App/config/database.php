<?php
namespace App\config;

use Config;
use Exception;

class database
{
    public $conn;

    public function __construct()
    {
        $config = new Config();
        $this->conn = $config->getConnection();
    }

    public function runQuery($sql)
    {
        return $this->conn->query($sql);
    }
    public function getLastInsertId() {
        return $this->conn->insert_id;
    }
    public function insertData($table, $data)
    {
        $userid = $_SESSION['user_id'];
        if(isset($data[0]['dessert_id'])){
            $p_id = $data[0]['dessert_id'];
            $qty = 1;
            $p_price = $data[0]['dessert_price'];
        }
        else if(isset($data[0]['drink_id'])){
            $p_id = $data[0]['drink_id'];
            $qty = 1;
            $p_price = $data[0]['drink_price'];
        }
        else if(isset($data[0]['sauce_id'])){
            $p_id = $data[0]['sauce_id'];
            $qty = 1;
            $p_price = $data[0]['sauce_price'];
        }

        $checkQuery = "SELECT * FROM cart WHERE p_id = '$p_id' and p_price= '$p_price' and user_id= '$userid'";
        $checkResult = $this->conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {

            $updateQuery = "UPDATE cart SET qty = qty + '$qty', total_price = total_price + '$p_price' WHERE p_id = '$p_id' and p_price= '$p_price' and user_id= '$userid'";
            if ($this->conn->query($updateQuery) === TRUE) {
            } else {
                echo "Veri güncellenirken hata oluştu: " . $this->conn->error;
            }
        } else {

            $insertQuery = "INSERT INTO cart (user_id ,p_id, p_price, qty) VALUES ('$userid' ,'$p_id', '$p_price', '$qty')";
            if ($this->conn->query($insertQuery) === TRUE) {
            } else {
                echo "Veri eklenirken hata oluştu: " . $this->conn->error;
            }
        }
    }
    public function insertMember($data)
    {
        $first_name = $data[0]['first_name'];
        $last_name = $data[0]['last_name'];
        $email = $data[0]['email'];
        $password = $data[0]['password'];
        $address = $data[0]['address'];

        $insertQuery = "INSERT INTO users (first_name,last_name, email, password, mobile, address) VALUES ('$first_name', '$last_name', '$email', '$password', '$address')";
        if ($this->conn->query($insertQuery) === TRUE) {
        } else {
            echo "Veri eklenirken hata oluştu: " . $this->conn->error;
        }
    }









}
