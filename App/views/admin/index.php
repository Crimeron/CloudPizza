<?php require __DIR__."/../../helpers/admincontrol.php"; ?>
<?php include_once "header.php";?>
<?php include_once "navbar.php";?>
<?php include_once "sidebar.php";?>
<?php
if(isset($_GET['pages'])){
  $pagesValue = $_GET['pages'];
  if($pagesValue == 'orders'){
    include __DIR__."/pages/orders.php";
  }
  else if($pagesValue == 'users'){
    include __DIR__."/pages/users.php";
  }
  else if($pagesValue == 'charts'){
    include __DIR__."/pages/charts.php";
  }
  else if($pagesValue == 'pizzas'){
    include __DIR__."/pages/pizza.php";
  }
  else if($pagesValue == 'drinks'){
    include __DIR__."/pages/drink.php";
  }
  else if($pagesValue == 'desserts'){
    include __DIR__."/pages/dessert.php";
  }
  else if($pagesValue == 'sauces'){
    include __DIR__."/pages/sauce.php";
  }
}else{
  include 'content.php';
}



?>
<?php include_once "footer.php";?>