<?php
namespace App\helpers;

// Giriş kontrolü
if (!isset($_SESSION['email'])) {
    echo $_SESSION["email"];
    header("location: login");
    exit;
}


?>