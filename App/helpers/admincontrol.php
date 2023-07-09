<?php
namespace App\helpers;

// Giriş kontrolü
if (!isset($_SESSION['isAdmin'])) {
    // Kullanıcı giriş yapmamış, giriş sayfasına yönlendir
    echo $_SESSION["email"];
    header("location: adminlogin");
    exit;
}


?>