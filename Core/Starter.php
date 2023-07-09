<?php

namespace Core;

use App\config\database;
use Core\Request;
require __DIR__ . '/Request.php';
require __DIR__ . '/View.php';
class Starter
{
    public $router;
    public $db;
    public $view;

    public function __construct()
    {
        $this->router = new \Bramus\Router\Router();
        $this->db = new database();
        $this->view = new View();
    }
}
