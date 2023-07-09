<?php 
namespace App\controllers;
use App\models\CartModel;
use Core\BaseController;

Class CartController extends BaseController{
    public $cart;
    public function loadCart()
    {
        $cartModel = new CartModel();
        $this->cart = $cartModel->getCart();
    }
    public function addtoCart($data){
        $cartModel = new CartModel();
        $cartModel->insertCart($data);
    }
}