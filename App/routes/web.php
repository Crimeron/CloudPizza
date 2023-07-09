<?php
$cms->router->get('/', '\App\controllers\CustomerController@showIndex');
$cms->router->get('/home', '\App\controllers\CustomerController@showIndex');
$cms->router->get('/products', '\App\controllers\CustomerController@showProducts');
$cms->router->get('/aboutus', '\App\controllers\CustomerController@showAboutUs');
$cms->router->get('/contact', '\App\controllers\CustomerController@showContact');
$cms->router->get('/cartlist', '\App\controllers\CustomerController@showCart');
$cms->router->get('/checkout', '\App\controllers\CustomerController@showCheck');
$cms->router->get('/login', '\App\controllers\CustomerController@showLogin');
$cms->router->get('/register', '\App\controllers\CustomerController@showRegister');
$cms->router->get('/profile', '\App\controllers\CustomerController@showProfile');
$cms->router->get('/orders', '\App\controllers\CustomerController@showOrders');

