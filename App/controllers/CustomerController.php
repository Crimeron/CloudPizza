<?php


namespace App\controllers;
require_once 'App/models/PizzaModel.php';
use App\models\MemberModel;
use Core\BaseController;
use App\controllers\PizzaController;
class CustomerController extends BaseController
{
    public function showIndex()
    {
        $this->view->load('index');
    }
    public function showProducts()
    {
        $pizzaController = new PizzaController();
        $pizzaController->index();
        $pizzaController->getDesserts();
        $pizzaController->getDrinks();
        $pizzaController->getSauces();
        $data = [
            'pizzaData' => $pizzaController->pizzas,
            'dessertData' => $pizzaController->dessert,
            'drinkData' => $pizzaController->drinks,
            'sauceData' => $pizzaController->sauces
        ];
        $this->view->load('products',$data);
    }
    public function showAboutUs()
    {
        $this->view->load('about');
    }
    public function showContact()
    {
        $this->view->load('contact');
    }
    public function showCart()
    {
        $cartController = new CartController();
        $cartController->loadCart();
        $this->view->load('cart_list', $cartController->cart);
    }
    public function showCheck()
    {
        $this->view->load('checkout');
    }
    public function showLogin(){
        $this->view->load('login');
    }
    public function showRegister(){
        $this->view->load('register');
    }
    public function showOrders(){
        $this->view->load('orders');
    }
    public function showProfile(){
        $MemberModel = new MemberModel();
        if(isset($_SESSION['email'])){
            $data = $MemberModel->checkMember($_SESSION['email']);
        }
        $this->view->load('profile', isset($data) ? $data : []);

    }
}


