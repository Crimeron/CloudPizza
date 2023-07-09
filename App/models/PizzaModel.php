<?php
namespace App\models;
use App\config\database;
use Core\BaseModel;

class PizzaModel extends BaseModel{
    public function getAllPizzas($status)
    {
        $sql = "SELECT * FROM product_list WHERE category_id = 1";
        if ($status === "both") {
            $sql .= " AND (status = 1 OR status = 0)";
        } elseif ($status === "only_1") {
            $sql .= " AND status = 1";
        } elseif ($status === "only_0") {
            $sql .= " AND status = 0";
        }
        $result = $this->db->runQuery($sql);

        $pizzas = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pizza = array(
                    'pizza_id' => $row['p_id'],
                    'pizza_category' => $row['category_id'],
                    'pizza_name' => $row['name'],
                    'pizza_description' => $row['description'],
                    'pizza_imgpath' => $row['img_path'],
                    'pizza_status' => $row['status'],
                    'pizza_price' => $row['price'],
                );

                $pizzas[] = $pizza;
            }
        }

        return $pizzas;
    }
    public function checkPrice($pizzaId) {
        $sql = "SELECT * FROM p_size WHERE p_id=" . $pizzaId;
        $result = $this->db->runQuery($sql);
    
        $prices = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $price = array(
                    'pizza_id' => $row['p_id'],
                    'pizza_small' => $row['small'],
                    'pizza_medium' => $row['medium'],
                    'pizza_large' => $row['large'],
                );
    
                $prices[] = $price;
            }
        }
    
        return $prices;
    }
    public function checkPizza($pizzaId) {
        $sql = "SELECT * FROM product_list WHERE p_id=" . $pizzaId;
        $result = $this->db->runQuery($sql);
    
        $prices = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $price = array(
                    'pizza_id' => $row['p_id'],
                    'pizza_category' => $row['category_id'],
                    'pizza_name' => $row['name'],
                    'pizza_description' => $row['description'],
                    'pizza_imgpath' => $row['img_path'],
                    'pizza_status' => $row['status'],
                    'pizza_price' => $row['price'],
                );
    
                $prices[] = $price;
            }
        }
    
        return $prices;
    }
    public function checkIngr($pizzaId) {
        $sql = "SELECT ingr FROM p_ingr WHERE p_id = '$pizzaId'";
        $result = $this->db->runQuery($sql);
    
        $ingredients = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ingredients[] = $row['ingr'];
            }
        }
    
        return $ingredients;
    }
    
    //! for Desserts

    public function getAllDesserts($status)
    {
        $sql = "SELECT * FROM product_list WHERE category_id = 2";
        if ($status === "both") {
            $sql .= " AND (status = 1 OR status = 0)";
        } elseif ($status === "only_1") {
            $sql .= " AND status = 1";
        } elseif ($status === "only_0") {
            $sql .= " AND status = 0";
        }
        $result = $this->db->runQuery($sql);

        $desserts = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $desert = array(
                    'dessert_id' => $row['p_id'],
                    'dessert_category' => $row['category_id'],
                    'dessert_name' => $row['name'],
                    'dessert_description' => $row['description'],
                    'dessert_imgpath' => $row['img_path'],
                    'dessert_status' => $row['status'],
                    'dessert_price' => $row['price'],
                );

                $desserts[] = $desert;
            }
        }

        return $desserts;
    }
    public function checkDessert($drinkId) {
        $sql = "SELECT * FROM product_list WHERE p_id=" . $drinkId;
        $result = $this->db->runQuery($sql);
    
        $desserts = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $desert = array(
                    'dessert_id' => $row['p_id'],
                    'dessert_category' => $row['category_id'],
                    'dessert_name' => $row['name'],
                    'dessert_description' => $row['description'],
                    'dessert_imgpath' => $row['img_path'],
                    'dessert_status' => $row['status'],
                    'dessert_price' => $row['price'],
                );

                $desserts[] = $desert;
            }
        }

        return $desserts;
    }
    
    //! for Drinks

    public function getAllDrinks($status)
    {
        $sql = "SELECT * FROM product_list WHERE category_id = 3";
        if ($status === "both") {
            $sql .= " AND (status = 1 OR status = 0)";
        } elseif ($status === "only_1") {
            $sql .= " AND status = 1";
        } elseif ($status === "only_0") {
            $sql .= " AND status = 0";
        }
        $result = $this->db->runQuery($sql);

        $drinks = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $drink = array(
                    'drink_id' => $row['p_id'],
                    'drink_category' => $row['category_id'],
                    'drink_name' => $row['name'],
                    'drink_description' => $row['description'],
                    'drink_imgpath' => $row['img_path'],
                    'drink_status' => $row['status'],
                    'drink_price' => $row['price'],
                );

                $drinks[] = $drink;
            }
        }

        return $drinks;
    }
    public function checkDrink($drinkId) {
        $sql = "SELECT * FROM product_list WHERE p_id=" . $drinkId;
        $result = $this->db->runQuery($sql);
    
        $drinks = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $drink = array(
                    'drink_id' => $row['p_id'],
                    'drink_category' => $row['category_id'],
                    'drink_name' => $row['name'],
                    'drink_description' => $row['description'],
                    'drink_imgpath' => $row['img_path'],
                    'drink_status' => $row['status'],
                    'drink_price' => $row['price'],
                );

                $drinks[] = $drink;
            }
        }

        return $drinks;
    }
    //! for Sauces

    public function getAllSauces($status)
    {

        $sql = "SELECT * FROM product_list WHERE category_id = 4";
        if ($status === "both") {
            $sql .= " AND (status = 1 OR status = 0)";
        } elseif ($status === "only_1") {
            $sql .= " AND status = 1";
        } elseif ($status === "only_0") {
            $sql .= " AND status = 0";
        }
        $result = $this->db->runQuery($sql);

        $sauces = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sauce = array(
                    'sauce_id' => $row['p_id'],
                    'sauce_category' => $row['category_id'],
                    'sauce_name' => $row['name'],
                    'sauce_description' => $row['description'],
                    'sauce_imgpath' => $row['img_path'],
                    'sauce_status' => $row['status'],
                    'sauce_price' => $row['price'],
                );

                $sauces[] = $sauce;
            }
        }

        return $sauces;
    }
    public function checkSauce($sauceId) {
        $sql = "SELECT * FROM product_list WHERE p_id=" . $sauceId;
        $result = $this->db->runQuery($sql);
    
        $sauces = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sauce = array(
                    'sauce_id' => $row['p_id'],
                    'sauce_category' => $row['category_id'],
                    'sauce_name' => $row['name'],
                    'sauce_description' => $row['description'],
                    'sauce_imgpath' => $row['img_path'],
                    'sauce_status' => $row['status'],
                    'sauce_price' => $row['price'],
                );

                $sauces[] = $sauce;
            }
        }

        return $sauces;
    }
}
