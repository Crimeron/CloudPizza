<?php
namespace App\controllers;

use Core\BaseController;
class PizzaController extends BaseController
{
    public $pizzas;
    public $prices;
    public $pizza;
    public $ingr;
    public $dessert;
    public $drinks;
    public $sauces;
    public function index()
    {
        $pizzaModel = new \App\models\PizzaModel();
        $this->pizzas = $pizzaModel->getAllPizzas('only_1');
    }
    public function getPrices($id){
        $pizzaModel = new \App\models\PizzaModel();
        $this->prices = $pizzaModel->checkPrice($id);
    }
    public function getPizza($id){
        $pizzaModel = new \App\models\PizzaModel();
        $this->pizza = $pizzaModel->checkPizza($id);
    }
    public function getIngr($id)
    {
        $pizzaModel = new \App\models\PizzaModel();
        $this->ingr = $pizzaModel->checkIngr($id);
    }
    public function getDesserts()
    {
        $pizzaModel = new \App\models\PizzaModel();
        $this->dessert = $pizzaModel->getAllDesserts('only_1');
    }
    public function getDessert($id)
    {
        $pizzaModel = new \App\models\PizzaModel();
        return $pizzaModel->checkDessert($id);
    }
    public function getDrinks()
    {
        $pizzaModel = new \App\models\PizzaModel();
        $this->drinks = $pizzaModel->getAllDrinks('only_1');
    }
    public function getDrink($id)
    {
        $pizzaModel = new \App\models\PizzaModel();
        return $pizzaModel->checkDrink($id);
    }
    public function getSauces()
    {
        $pizzaModel = new \App\models\PizzaModel();
        $this->sauces = $pizzaModel->getAllSauces('only_1');
    }
    public function getSauce($id)
    {
        $pizzaModel = new \App\models\PizzaModel();
        return $pizzaModel->checkSauce($id);
    }
}
