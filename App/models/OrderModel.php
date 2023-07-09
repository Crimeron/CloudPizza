<?php
namespace App\models;
use App\config\database;
use Core\BaseModel;
class OrderModel extends BaseModel
{

    public function createOrder($usermail)
    {
        $cartModel = new CartModel();
        $memberModel = new MemberModel();
        $MemberData = $memberModel->checkMember($usermail);
        foreach ($MemberData as $memberDataItem) {
            $userid = $memberDataItem['user_id'];
            $first_name = $memberDataItem['user_firstname'];
            $last_name = $memberDataItem['user_lastname'];
            $email = $memberDataItem['user_email'];
            $mobile = $memberDataItem['user_mobile'];
            $address = $memberDataItem['user_address'];
            $date = date('y-m-d H:i:s');
    
            // Daha önce sipariş kontrolü
            $previousOrderSql = "SELECT * FROM orders WHERE user_id = '$userid' ORDER BY id DESC LIMIT 1";
            $previousOrderResult = $this->db->runQuery($previousOrderSql);
    
            if ($cartModel->isCartEmpty($userid) === true) {
                echo "Sepet boş. Sipariş verilemez.";
                header("location: products?empty");
                return;
            }
    
            if ($previousOrderResult->num_rows > 0) {
                $previousOrderData = $previousOrderResult->fetch_assoc();
                $previousOrderStatus = $previousOrderData['status'];
                if ($previousOrderStatus == 'Başarılı') {
                    $sql = "INSERT INTO orders (user_id, first_name, last_name, email, mobile, address, order_date)
                            VALUES ('$userid', '$first_name', '$last_name', '$email', '$mobile', '$address', '$date')";
    
                    $result = $this->db->runQuery($sql);
                    if ($result === true) {
                        $order_id = $this->db->getLastInsertId();
    
                        $this->createOrderDetail($userid, $order_id);
                        $cartModel->deleteCart($userid);
                    } else {
                        echo "Sorgu başarısız";
                    }
                } else {
                    echo "Devam etmekte olan siparişiniz var";
                    header("location: products?alreadyorder");
                    return;
                }
            } else {
                $sql = "INSERT INTO orders (user_id, first_name, last_name, email, mobile, address, order_date)
                        VALUES ('$userid', '$first_name', '$last_name', '$email', '$mobile', '$address', '$date')";
    
                $result = $this->db->runQuery($sql);
                if ($result === true) {
                    $order_id = $this->db->getLastInsertId();
                    $this->createOrderDetail($userid, $order_id);
    
                    $cartModel->deleteCart($userid);
                } else {
                    echo "Sorgu başarısız";
                }
            }
        }
    }
    
    


public function createOrderDetail($userid, $order_id)
{
    $cartModel = new CartModel();
    $CartData = $cartModel->getCart();
    foreach ($CartData as $cartitem) {
        $product_id = $cartitem['product_id'];
        $p_price = $cartitem['p_price'];
        $product_qty = $cartitem['product_qty'];
        $total_price = $cartitem['total_price'];
        $product_name = $cartitem['product_name'];
        $product_size = $cartitem['product_size'];

        $sql = "INSERT INTO order_detail (order_id, user_id, p_id, p_price, qty, total_price, p_name, size)
                VALUES ('$order_id', '$userid', '$product_id', '$p_price', '$product_qty', '$total_price', '$product_name', '$product_size')";

        $result = $this->db->runQuery($sql);
    }
}
public function getOrder($userid)
{

    $sql = "SELECT od.order_id, od.p_name, od.qty, od.total_price, o.status, o.order_date
    FROM order_detail od 
    INNER JOIN orders o ON od.user_id = o.user_id 
    WHERE od.user_id = '$userid' AND od.order_id = o.id;";

    $result = $this->db->runQuery($sql);

    $orderDetails = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orderDetails[] = $row;
        }
    }

    return $orderDetails;
}

public function getOrders()
{

    $sql = "SELECT id, user_id, first_name, last_name, address, mobile, status
    FROM orders
    ORDER BY status ASC;
    ";

    $result = $this->db->runQuery($sql);

    $orderDetails = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orderDetails[] = $row;
        }
    }

    return $orderDetails;
}
    public function getOrderDetails($orderid)
    {

        $sql = "SELECT * FROM order_detail
        WHERE order_id = '$orderid';";

        $result = $this->db->runQuery($sql);

        $orderDetails = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orderDetails[] = $row;
            }
        }

        return $orderDetails;
    }

}
