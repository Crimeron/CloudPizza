<?php
namespace Core;

class View{
    public function load($viewName, $data = [])
    {
        extract($data); // Veriyi değişkenlere ayır
        require_once __DIR__ . '/../App/views/' . $viewName . '.php';
    }
    public function adminload($viewName, $data = [])
    {
        extract($data); // Veriyi değişkenlere ayır
        require_once __DIR__ . '/../App/views/admin/' . $viewName . '.php';
    }


}