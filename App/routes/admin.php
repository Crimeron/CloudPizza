<?php

$cms->router->get('/admin', '\App\controllers\AdminController@showDashboard');
$cms->router->get('/adminlogin', '\App\controllers\AdminController@showAdminLogin');
$cms->router->post('/admin/addpizza', '\App\controllers\AdminController@addPizza');