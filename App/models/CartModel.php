<?php
namespace App\models;
use App\config\database;
use Core\BaseModel;

class CartModel extends BaseModel
{
    public function getCart()
    {
        if(isset($_SESSION['user_id'])){
            $userid = $_SESSION['user_id'];
            $sql = "SELECT cart.cart_id, cart.p_id, cart.p_price, cart.qty, cart.total_price, cart.size,product_list.name 
                    FROM cart 
                    INNER JOIN product_list ON cart.p_id = product_list.p_id WHERE cart.user_id = '$userid'";
            $result = $this->db->runQuery($sql);
        
            $cart = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tempCart = array(
                        'cart_id' => $row['cart_id'],
                        'product_id' => $row['p_id'],
                        'p_price' => $row['p_price'],
                        'product_qty' => $row['qty'],
                        'total_price' => $row['total_price'],
                        'product_name' => $row['name'],
                        'product_size' => $row['size'],
                    );
        
                    $cart[] = $tempCart;
                }
            }
        }
        else{
            $tempCart = array(
                'cart_id' => 0,
                'product_id' => 0,
                'p_price' => 0,
                'product_qty' => 0,
                'total_price' => 0,
                'product_name' => 0,
                'product_size' => 0,
            );

            $cart[] = $tempCart;
        }

        return $cart;
    }
    
    public function insertCart($data){
        $this->db->insertData("cart",$data);
        
    }
    

    public function deleteCart($userid){
        $query = "DELETE from cart where '$userid'";
        $this->db->runQuery($query);
    }

    public function isCartEmpty($userid)
    {
        // Sepetin dolu olup olmadığını kontrol etmek için gerekli sorguları yazın ve sonucu döndürün
        $sql = "SELECT COUNT(*) AS count FROM cart WHERE user_id = '$userid'";
        $result = $this->db->runQuery($sql);
        $row = $result->fetch_assoc();
        $count = $row['count'];

        return ($count == 0); // Sepet boş ise true, dolu ise false döndürür
    }
}