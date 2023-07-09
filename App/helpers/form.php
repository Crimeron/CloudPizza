<?php

namespace App\helpers;
use App\controllers\CustomerController;
use Core\Starter;
use mysqli;

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "cloudpizza_db"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız oldu: " . $conn->connect_error);
}
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $user = $checkResult->fetch_assoc();
        $storedPassword = $user['password'];

        if (password_verify($password, $storedPassword)) {
            // Kullanıcı girişi başarılı, oturumu başlat
            session_start();
            $_SESSION["logged_in"] = 'true';
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];

            echo "2";

        } else {
            echo "1";
        }
    } else {
        echo "0";
    }
    // 2 = succesfull, 1 = wrong paswrd or email, 0 = user not exist 
}

if (isset($_POST['isAdmin'])) {
    $userName = $_POST['username'];
    $password = $_POST['password'];

    $checkQuery = "SELECT * FROM admins WHERE username = '$userName'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $user = $checkResult->fetch_assoc();
        $storedPassword = $user['password'];

        if ($password = $storedPassword) {
            // Kullanıcı girişi başarılı, oturumu başlat
            session_start();
            $_SESSION["logged_in"] = 'true';
            $_SESSION['username'] = $user['username'];
            $_SESSION['isAdmin'] = '1';

            echo "2";

        } else {
            echo "1";
        }
    } else {
        echo "0";
    }
    // 2 = succesfull, 1 = wrong paswrd or email, 0 = user not exist 
}


if (isset($_POST['register'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $mobile = trim($_POST['mobile']);
    $address = trim($_POST['address']);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $date = date('y-m-d H:i:s');

    if (strlen($firstName) < 3 || strlen($lastName) < 3) {
        echo "Name and surname must be at least 3 characters.";
        return;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address format!";
        return;
    }

    // Validate phone number
    $phoneNumberPattern = "/^\d{10}$/";
    if (!preg_match($phoneNumberPattern, $mobile)) {
        echo "Invalid phone number format!";
        return;
    }

    // Validate address
    if (strlen($address) < 10) {
        echo "Address must be at least 10 characters.";
        return;
    }

    // Validate password
    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters.";
        return;
    }

    // Check if phone number is already registered
    $checkPhoneQuery = "SELECT * FROM users WHERE mobile = '$mobile'";
    $checkPhoneResult = $conn->query($checkPhoneQuery);

   
    if ($checkPhoneResult->num_rows > 0) {
        echo "Bu telefon numarası zaten kayıtlı!";
        return; 
    }

    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        echo "This email address is already registered!";
        return; 
    }

    $insertQuery = "INSERT INTO users (first_name, last_name, email, password, mobile, address, created_at) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$mobile', '$address', '$date')";
    $insertResult = $conn->query($insertQuery);

    if ($insertResult === TRUE) {
        echo "Welcome to CloudPizza";
        } else {
        echo "Veritabanı sorgusu çalışırken bir hata oluştu: " . $conn->error;
    }
}



if (isset($_POST['save'])) {
    $userId = $_POST['userid'];
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $mobile = trim($_POST['mobile']);
    $address = $_POST['address'];

    // Perform input validation
    $errors = [];
    if (strlen($firstName) < 2) {
        $errors[] = 'Your name must be more than 2 characters';
    }
    if (strlen($lastName) < 2) {
        $errors[] = 'Your last name must be more than 2 characters';
    }
    if (strlen($mobile) != 10) {
        $errors[] = 'Your phone number must be 10 digits';
    }
    // Add more validation rules for other fields as needed

    if (!empty($errors)) {
        $response = array('status' => 'error', 'message' => implode(' ', $errors));
        echo json_encode($response);
    } else {
        $sql = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', mobile = '$mobile', address = '$address' WHERE id = '$userId'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            $response = array('status' => 'success', 'message' => 'Kaydedildi');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'Veritabanı sorgusu çalışırken bir hata oluştu: ' . $conn->error);
            echo json_encode($response);
        }
    }
    
}
if (isset($_POST['pizzaupdate']) && $_POST['pizzaupdate'] == 'true') {
    // Var olan pizzayı güncelle
    $pizzaID = $_POST['pizzaID'];
    $name = trim($_POST['name']);
    $description = $_POST['description'];
    $status = $_POST['status'];
    $price_small = $_POST['price_small'];
    $price_medium = $_POST['price_medium'];
    $price_large = $_POST['price_large'];

    // Veritabanında güncelleme işlemini gerçekleştir
    // Örnek olarak:
    $query = "UPDATE product_list SET name = '$name', description = '$description', status = '$status', price = '$price_small' WHERE p_id = '$pizzaID'";
    $success = $conn->Query($query);
    $query2 = "UPDATE p_size SET small = '$price_small', medium = '$price_medium', large = '$price_large',";
    $conn->Query($query2);
    // Başarı durumunu kontrol et ve gerekli işlemleri yap
    if ($success) {
        echo "Pizza başarıyla güncellendi.";
    } else {
        echo "Pizza güncelleme işlemi başarısız oldu.";
    }
} else {
    // Yeni bir pizza ekle
    if (isset($_POST['pizzasave'])) {
        $name = trim($_POST['name']);
        $description = $_POST['description'];
        $status = $_POST['status'];
        $price_small = $_POST['price_small'];
        $price_medium = $_POST['price_medium'];
        $price_large = $_POST['price_large'];
    
        // Aynı isimde pizza kaydı var mı kontrol et
        $checkQuery = "SELECT * FROM product_list WHERE name = '$name'";
        $checkResult = $conn->query($checkQuery);
    
        if ($checkResult->num_rows > 0) {
            echo "Bu pizza adı zaten mevcut.";
        } else {
            // Yeni pizza kaydını ekle
            $query = "INSERT INTO product_list (name, description, status, price, category_id) VALUES ('$name', '$description', '$status', '$price_small', '1')";
            $stmt = $conn->query($query);
            $p_id = $conn->insert_id;
    
            // p_size tablosuna yeni verileri ekle
            $query = "INSERT INTO p_size (p_id, small, medium, large) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iddd", $p_id, $price_small, $price_medium, $price_large);
            $stmt->execute();
    
            $stmt->close();
            $success = true;
    
            if ($success) {
                echo "Pizza başarıyla eklendi.";
            } else {
                echo "Pizza ekleme işlemi başarısız oldu.";
            }
        }
    }
    
    
}
if (isset($_POST['productSave'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];
    $price = $_POST['price'];
    $categoryId = $_POST['categoryId'];

    $query = "INSERT INTO product_list (name, description, status, price, category_id) VALUES ('$name', '$description', '$status', '$price', '$categoryId')";
    $success = $conn->query($query);

    if ($success) {
        echo "Ürün başarıyla kaydedildi.";
    } else {
        echo "Ürün kaydetme işlemi başarısız oldu.";
    }
}


















