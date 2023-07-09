<?php
namespace App\controllers;
use App\models\AdminModel;
use App\models\OrderModel;
use App\models\PizzaModel;
use Core\BaseController;



class AdminController extends BaseController{
    public function showDashboard() {
        $adminModel = new AdminModel();
        $totalNewOrders = $adminModel->getOrdersCount('Onay Bekliyor');
        $totalConfirmedOrders = $adminModel->getOrdersCount('Onaylandı');
        $totalFinishedOrders = $adminModel->getOrdersCount('Tamamlandı');
        $totalMembers = $adminModel->getMembersCount();
        // Diğer işlemler...
        $this->view->adminload('index', [
            'totalNewOrders' => $totalNewOrders,
            'totalConfirmedOrders' => $totalConfirmedOrders,
            'totalFinishedOrders' => $totalFinishedOrders,
            'totalMembers' => $totalMembers
        ]);
    }
    public function showAdminLogin(){
        $this->view->adminload('login');
    }
    public function getOrders(){
        $orderModel = new OrderModel();
        return $orderModel->getOrders();
    }
    public function getMembers(){
        $adminModel = new AdminModel();
        return $adminModel->getAllMembers();
    }
    public function getChartDatas(){
        $adminModel = new AdminModel();
        return $adminModel->getDataForChart();
    }

    public function getPizzas(){
        $pizzaModel = new PizzaModel();
        return $pizzaModel->getAllPizzas('both');
    }
    
    public function deletePizza()
    {
        $id = $_POST['id'];
        $adminModel = new AdminModel();
        $adminModel->deletePizza($id);
    }
    public function addPizza()
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $status = isset($_POST['status']) ? 1 : 0;
        $price_small = $_POST['price_small'];
        $price_medium = $_POST['price_medium'];
        $price_large = $_POST['price_large'];


        // Verileri model fonksiyonuna göndererek kaydetme işlemini gerçekleştir
        $adminModel = new AdminModel();
        $adminModel->addPizza($name, $description, $status, $price_small, $price_medium, $price_large);

        // Başarılı bir şekilde eklendiğinde yönlendirme veya mesaj görüntüleme gibi işlemler yapılabilir
        // ...
    }
    public function getPizzaDetails($pizzaID){
        $adminModel = new AdminModel();
        return $adminModel->getPizzaDetails($pizzaID);
    }

    
    public function getProduct($categoryID){
        $adminModel = new AdminModel();
        return $adminModel->getAllProducts($categoryID);
    }
}