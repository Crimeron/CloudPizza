<?php
namespace App\controllers;
use App\models\OrderModel;
use Core\BaseController;
class OrderController extends BaseController
{

    public function placeOrder()
    {
        $usermail = $_SESSION['email'];
        $orderModel = new OrderModel();
        $orderModel->createOrder($usermail);
    }
    public function getOrder(){
        $userid = $_SESSION['user_id'];
        $orderModel = new OrderModel();
        return $orderModel->getOrder($userid);
    }
    public function getOrderDetails($orderID){
        $orderModel = new OrderModel();
        return $orderModel->getOrderDetails($orderID);
    }

}
