<?php
use App\controllers\CartController;
use App\controllers\PizzaController;

if (isset($_GET['pizza'])) {
    require __DIR__."/../helpers/control.php";
    $pizzaId = $_GET['pizza'];
    include __DIR__.'/view_prod.php';
    exit;
}
if (isset($_GET['dessert'])) {
    require __DIR__."/../helpers/control.php";
    $dessertId = $_GET['dessert'];
    $cartController = new CartController();
    $pizzaController = new PizzaController();
    $dessert = $pizzaController->getDessert($dessertId);
    $cartController->addtoCart($dessert);
}
if (isset($_GET['drink'])) {
    require __DIR__."/../helpers/control.php";
    $drinkId = $_GET['drink'];
    $cartController = new CartController();
    $pizzaController = new PizzaController();
    $drink = $pizzaController->getDrink($drinkId);
    $cartController->addtoCart($drink);
}
if (isset($_GET['sauce'])) {
    require __DIR__."/../helpers/control.php";
    $drinkId = $_GET['sauce'];
    $cartController = new CartController();
    $pizzaController = new PizzaController();
    $sauce = $pizzaController->getSauce($drinkId);
    $cartController->addtoCart($sauce);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include 'links.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container">
    <div class="quick_filter">
    <div class="filter_item" data-category="all">
        <div>All Products</div>
    </div>
    <div class="filter_item" data-category="1">
        <div>Pizzas</div>
    </div>
    <div class="filter_item" data-category="2">
        <div>Desserts</div>
    </div>
    <div class="filter_item" data-category="3">
        <div>Drinks</div>
    </div>
    <div class="filter_item" data-category="4">
        <div>Sauces</div>
    </div>
</div>
<div class="notification-container"></div>
        <div class="row">
        <?php
        foreach ($pizzaData as $pizza) {
            echo '<div class="col-lg-3 animate-slide-up">';
            echo '<div class="card mt-4" style="width: 100%;" data-category="' . $pizza['pizza_category'] . '">';
            echo '<img class="card-img-top" src="/CloudPizza/Public/assets/img/Pizzas/Pizza_mix.jpg" alt="Pizza Image">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title text-center">' . $pizza['pizza_name'] . '</h5>';
            echo '<p class="card-text">' . $pizza['pizza_description'] . '</p>';
            echo '<a href="?pizza=' . $pizza['pizza_id'] . '" class="buy-btn">Give Order</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        foreach ($dessertData  as $dessert) {
            echo '<div class="col-lg-3 animate-slide-up">';
            echo '<div class="card mt-4" style="width: 100%;" data-category="' . $dessert['dessert_category'] . '">';
            echo '<img class="card-img-top" src="/CloudPizza/Public/assets/img/Desserts/dessert1.jpg" alt="dessert Image">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title text-center">' . $dessert['dessert_name'] . '</h5>';
            echo '<p class="card-text">' . $dessert['dessert_description'] . '</p>';
            echo '<a href="?dessert=' . $dessert['dessert_id'] . '" class="buynotifi buy-btn">Give Order</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        foreach ($drinkData as $drink) {
            echo '<div class="col-lg-3 animate-slide-up">';
            echo '<div class="card mt-4" style="width: 100%;" data-category="' . $drink['drink_category'] . '">';
            echo '<img class="card-img-top" src="/CloudPizza/Public/assets/img/Drinks/Cola.jpg" alt="Pizza Image">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title text-center">' . $drink['drink_name'] . '</h5>';
            echo '<p class="card-text">' . $drink['drink_description'] . '</p>';
            echo '<a href="?drink=' . $drink['drink_id'] . '" class="buy-btn">Give Order</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        foreach ($sauceData as $sauce) {
            echo '<div class="col-lg-3 animate-slide-up">';
            echo '<div class="card mt-4" style="width: 100%;" data-category="' . $sauce['sauce_category'] . '">';
            echo '<img class="card-img-top" src="/CloudPizza/Public/assets/img/Sauces/sauce1.jpg" alt="Pizza Image">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title text-center">' . $sauce['sauce_name'] . '</h5>';
            echo '<p class="card-text">' . $sauce['sauce_description'] . '</p>';
            echo '<a href="?sauce=' . $sauce['sauce_id'] . '" class="buy-btn">Give Order</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        
        <!-- <div class="col-lg-3">
        <div class="card mt-4" style="width: 18rem;">
            <img class="card-img-top" src="/CloudPizza/Public/assets/img/Pizzas/Pizza_mix.jpg" alt="Pizza Image">
                <div class="card-body">
                    <h5 class="card-title text-center">Pizza Mix</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="?pizza=1" class="buy-btn">Give Order</a>
                </div>
            </div>
        </div>-->
        </div>
    </div>
<?php
    if (isset($_GET['empty'])) {
        echo '<div class="notificationError" class="notification-balloon">Sepet boş. Sipariş verilemez.</div>';
    }
    if (isset($_GET['alreadyorder'])) {
        echo '<div class="notificationError" class="notification-balloon">Devam etmekte olan siparişiniz var</div>';
      }
  ?>

    <script>
         $(document).ready(function() {
      function showNotification(message) {
        $('.notificationError').text(message);
        $('.notificationError').fadeIn(300).delay(2000).fadeOut(300);
      }

      // Sayfa yüklendiğinde bildirimi göster
      $(window).on('load', function() {
        <?php
          if (isset($_GET['empty'])) {
            echo "showNotification('Sepet boş. Sipariş verilemez.');";
          }
          if (isset($_GET['sameperson'])) {
            echo "showNotification('Birden fazla sipariş veremezsiniz.');";
          }
        ?>
      });
    });
        $(document).ready(function() {
            $('.filter_item').click(function() {
                var category = $(this).data('category');

                $('.card').each(function() {
                    var cardCategory = $(this).data('category');

                    if (category === 'all' || cardCategory === category) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
            $('.buynotifi').click(function() {

            let notification = $('<div class="notification">Added to Cart</div>');
            $('.notification-container').append(notification);

            notification.fadeIn().delay(2000).fadeOut(function() {
                $(this).remove();
            });

            notificationCount++;
            $('.notification').each(function(index) {
                $(this).css('bottom', (index * 60) + 'px');
            });
            });
        });
        
    </script>
          <?php include 'footer.php' ?>
</body>
</html>