<?php
session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/App/config/config.php';
require __DIR__ . '/Core/Starter.php';

use Core\Starter;

$cms = new Starter();

require __DIR__. '/App/Routes/Route.php';
?>