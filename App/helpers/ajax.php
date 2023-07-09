<?php
namespace App\helpers;
use mysqli;

if (isset($_POST['cartget'])) {
    $cartData = json_decode($_POST['cartget'], true);
}

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "cloudpizza_db"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız oldu: " . $conn->connect_error);
}

if (isset($_POST['cartget'])) {
    $cartData = json_decode($_POST['cartget'], true);
    $productId = $cartData[0]['p_id'];
    $productPrice = $cartData[0]['p_price'];
    $quantity = $cartData[0]['qty'];
    $size = $cartData[0]['p_size'];
    $removedingr = $cartData[0]['removeding'];
    $userid = $cartData[0]['userid'];
    $checkQuery = "SELECT * FROM cart WHERE p_id = '$productId' and p_price= '$productPrice' and user_id= '$userid'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {

        $updateQuery = "UPDATE cart SET qty = qty + '$quantity', total_price = total_price + '$productPrice' WHERE p_id = '$productId' and p_price= '$productPrice' and user_id= '$userid'";
        if ($conn->query($updateQuery) === TRUE) {
            echo "Veri başarıyla güncellendi";
        } else {
            echo "Veri güncellenirken hata oluştu: " . $conn->error;
        }
    } else {

        $insertQuery = "INSERT INTO cart (user_id ,p_id, p_price, qty, size) VALUES ('$userid' ,'$productId', '$productPrice', '$quantity', '$size')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "Veri başarıyla eklendi";
        } else {
            echo "Veri eklenirken hata oluştu: " . $conn->error;
        }
    }
}

if (isset($_POST['productName']) && isset($_POST['pPrice'])) {
    $productName = $_POST['productName'];
    $productPrice = $_POST['pPrice'];

    $sql = "DELETE cart.*
            FROM cart
            INNER JOIN product_list ON cart.p_id = product_list.p_id
            WHERE product_list.name = '$productName' AND cart.p_price = '$productPrice'";


    if ($conn->query($sql) === TRUE) {
        echo "Veri başarıyla silindi";
    } else {
        echo "Veri silinirken hata oluştu: " . $conn->error;
    }
}

if (isset($_POST['userId'])) {
    $userid = $_POST['userId'];

    $sql = "DELETE FROM order_detail
            WHERE order_id IN (
                SELECT id
                FROM orders
                WHERE user_id = '$userid'
            );";

    $sql .= "DELETE FROM orders
              WHERE user_id = '$userid';";

    if ($conn->multi_query($sql) === TRUE) {
        echo "Veri başarıyla silindi";
    } else {
        echo "Veri silinirken hata oluştu: " . $conn->error;
    }
}
if (isset($_POST['userID'])) {
    $userid = $_POST['userID'];

    $sql = "DELETE FROM users
            WHERE id = '$userid';";

    if ($conn->multi_query($sql) === TRUE) {
        echo "Veri başarıyla silindi";
    } else {
        echo "Veri silinirken hata oluştu: " . $conn->error;
    }
}

if (isset($_POST['StatusUpdate'])) {
    $orderid = $_POST['orderId'];


    $selectSql = "SELECT status FROM orders WHERE id = '$orderid'";
    $selectResult = $conn->query($selectSql);

    if ($selectResult) {
        if ($selectResult->num_rows > 0) {
            $row = $selectResult->fetch_assoc();
            $currentStatus = $row['status'];

            if($currentStatus == 'Onay Bekliyor'){
                $newStatus = "Onaylandı";
            }
            else if($currentStatus == "Onaylandı"){
                $newStatus = "Yolda";
            }
            else if($currentStatus == "Yolda"){
                $newStatus = "Başarılı";
            }else{
                $newStatus = "Onay Bekliyor";
            }
            $updateSql = "UPDATE orders SET status = '$newStatus' WHERE id = '$orderid'";
            $updateResult = $conn->query($updateSql);

            if ($updateResult === TRUE) {
                echo "Veri başarıyla güncellendi";
            } else {
                echo "Veri güncellenirken hata oluştu: " . $conn->error;
            }
        } else {
            echo "Kullanıcıya ait sipariş bulunamadı";
        }
    } else {
        echo "Veri alınırken hata oluştu: " . $conn->error;
    }
}
if (isset($_POST['id'])) {
    $productId = $_POST['id'];
    $query = "DELETE FROM product_list WHERE p_id = '$productId'";
    $conn->Query($query);
    $query2 = "DELETE FROM p_size WHERE p_id = '$productId'";
    $conn->Query($query2);
}
if (isset($_POST['productID'])) {
    $productId = $_POST['productID'];
    $query = "DELETE FROM product_list WHERE p_id = '$productId'";
    $conn->Query($query);
}
if (isset($_POST['status'])) {
    $productId = $_POST['productid'];

    $query = "SELECT status FROM product_list WHERE p_id = '$productId'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentStatus = $row['status'];

        $newStatus = ($currentStatus == '1') ? '0' : '1';

        $query = "UPDATE product_list SET status = '$newStatus' WHERE p_id = '$productId'";
        $conn->query($query);
    }
}
if (isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
    $productName = $_POST['productName'];
    $sum = $_POST['sum'];

    $orderQuery = "SELECT p_id FROM product_list WHERE name = '$productName'";
    $orderResult = $conn->query($orderQuery);

    if ($orderResult->num_rows > 0) {
        $row = $orderResult->fetch_assoc();
        $p_id = $row['p_id'];

        $query = "UPDATE cart SET qty = '$quantity', total_price = '$sum' WHERE p_id = '$p_id'";
        $updateResult = $conn->query($query);

        if ($updateResult === TRUE) {
            echo "Veri başarıyla güncellendi";
        } else {
            echo "Veri güncellenirken hata oluştu: " . $conn->error;
        }
    } else {
        echo "Belirtilen ürün bulunamadı";
    }
}












$conn->close();
?>

