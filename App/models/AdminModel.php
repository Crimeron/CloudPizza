<?php


namespace App\models;
use Core\BaseModel;

class AdminModel extends BaseModel
{
    public function getOrdersCount($status){
        $sql = "SELECT COUNT(*) AS total_orders
        FROM orders
        WHERE status = '$status';";
        $result = $this->db->runQuery($sql);
        $row = $result->fetch_assoc();
        $totalOrders = $row['total_orders'];
        return $totalOrders;
    }
    public function getMembersCount(){
        $sql = "SELECT COUNT(*) AS total_members
        FROM users";
        $result = $this->db->runQuery($sql);
        $row = $result->fetch_assoc();
        $totalMembers = $row['total_members'];
        return $totalMembers;
    }
    public function getAllMembers(){
        $sql = "SELECT * FROM users";
        $result = $this->db->runQuery($sql);
        $AllMembers = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $AllMembers[] = $row;
            }
        }
    
        return $AllMembers;
    }
    public function getDataForChart()
    {
        $query = "SELECT COUNT(*) AS user_count, DATE(created_at) AS registration_date FROM users GROUP BY registration_date";
        $result = $this->db->runQuery($query);

        $userCounts = [];
        $registrationDates = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $userCounts[] = (int)$row['user_count'];
            $registrationDates[] = $row['registration_date'];
        }

        $query = "SELECT DATE(order_date) AS order_date, COUNT(*) AS order_count FROM orders GROUP BY DATE(order_date)";
        $result = $this->db->runQuery($query);        

        $orderCounts = [];
        $orderDates = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orderCounts[] = (int)$row['order_count'];
            $orderDates[] = $row['order_date'];
        }

        $data = [
            'userData' => $userCounts,
            'orderData' => $orderCounts,
            'labels' => $registrationDates
        ];

        $jsonData = json_encode($data);

        return $jsonData;
    }
    public function deletePizza($productId)
    {
        $query2 = "DELETE FROM p_size WHERE p_id = '$productId'";
        $this->db->runQuery($query2);
        $query = "DELETE FROM product_list WHERE p_id = '$productId'";
        $this->db->runQuery($query);
    }
    
    
    public function getPizzaDetails($pizzaid)
    {

        $sql = "SELECT pl.*, ps.* FROM product_list pl
        JOIN p_size ps ON pl.p_id = ps.p_id
        WHERE pl.p_id = '$pizzaid';";


$result = $this->db->runQuery($sql);

$pizzaDetails = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
                $pizzaDetails[] = $row;
            }
        }

        return $pizzaDetails;
    }
    public function getAllProducts($categoryID)
    {
        $sql = "SELECT * FROM product_list WHERE category_id = '$categoryID'";
        $result = $this->db->runQuery($sql);
        
        $productDetails = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productDetails[] = $row;
            }
        }
        
        return $productDetails;
    }
    public function addPizza($name, $description, $status, $price_small, $price_medium, $price_large)
    {
    
        // $query = "INSERT INTO product_list (name, description, status, price, category_id) VALUES (?, ?, ?, ?, ?)";
        // $stmt = $this->db->runQuery($query);
        // $stmt->bind_param("sssd", $name, $description, $status, $price_small, '1');
        // $stmt->execute();
    
    
        // $p_id = $stmt->insert_id;
    
        // $stmt->close();
    
        // $query = "INSERT INTO p_size (p_id, small, medium, large) VALUES (?, ?, ?, ?)";
        // $stmt = $this->db->runQuery($query);
        // $stmt->bind_param("iddd", $p_id, $price_small, $price_medium, $price_large);
        // $stmt->execute();
    
        // $stmt->close();
    }
}