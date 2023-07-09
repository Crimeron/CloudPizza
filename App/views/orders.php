<?php
use App\controllers\OrderController;
require __DIR__."/../helpers/control.php";
$orderController = new OrderController();
$orderDetails = $orderController->getOrder();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include 'links.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Public/assets/img/Logo/Logo.png" />
    <title>CloudPizza</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container">
    <div class="order-container">
    <h2>Siparişlerim</h2>

    <table class="table" style="color: white; font-weight:400;">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                 <th>Total Price</th>
                 <th>Status</th>
                 <th>Date Ordered</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($orderDetails as $orderDetail) {
                echo '<tr>';
                echo '<td>' . $orderDetail['order_id'] . '</td>';
                echo '<td>' . $orderDetail['p_name'] . '</td>';
                echo '<td>' . $orderDetail['qty'] . '</td>';
                echo '<td>' . $orderDetail['total_price'] . '</td>';
                echo '<td>' . $orderDetail['status'] . '</td>';
                echo '<td>' . $orderDetail['order_date'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
    </div>
    <?php include 'footer.php' ?>

</body>
</html>