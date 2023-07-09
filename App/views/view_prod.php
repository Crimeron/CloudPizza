<?php
use App\controllers\CartController;
use App\Controllers\PizzaController;
    $price = new PizzaController();
    $price->getPrices($id = $_GET['pizza']);
    $price->getPizza($id = $_GET['pizza']);
    
    $pizzaSmallPrice = $price->prices[0]['pizza_small'];
    $pizzaMediumPrice = $price->prices[0]['pizza_medium'];
    $pizzaLargePrice = $price->prices[0]['pizza_large'];
    $price->getIngr($_GET['pizza']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include 'links.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/css/style.css">
    <title>Products</title>
    <style>
        @media (max-width: 516px) { 
            .cartbutton {
                font-size: 18px;
                padding: 5px 10px;
            }
            .price {
                font-size: 20px;
                padding: 5px 10px;
            }
        }
        @media (max-width: 400px) { 
            .cartbutton {
                font-size: 12px;
                padding: 5px 10px;
            }
            .price {
                font-size: 16px;
                padding: 5px 10px;
            }
        }
</style>
</head>
<body>
    <?php include 'navbar.php'?>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 mt-4">
                <img style="border-radius: 50px; max-width: 100%;" src="/CloudPizza/Public/assets/img/Pizzas/Pizza_mix.jpg" alt="">
            </div>
            <div class="col-lg-8 col-xl-8 mt-4">
                <div class="pricebox">
                    <div class="price">Price = <div class="fiyat" id="pizzaPrice"><?=$pizzaSmallPrice?></div> TL</div>
                    <div class="miktar">
                        <div class="countbox">
                            <button class="azaltan">-</button>
                            <div class="counter" style="color:black">1</div>
                            <button class="arttiran">+</button>
                        </div>
                        <div class="cartbutton" style="margin-right:1rem;">
                            <div>Add to Cart</div>
                        </div>
                    </div>
                </div>
                <div class="notification-container"></div>
                <div class="boyutbox mt-4">
                    <div class="boyut">
                    <div class="radio-inputs">
                        <label class="radio">
                            <input type="radio" name="radio" value="small" checked="">
                            <span class="name">Small</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="radio" value="medium">
                            <span class="name">Medium</span>
                        </label>
                            
                        <label class="radio">
                            <input type="radio" name="radio" value="large">
                            <span class="name">Large</span>
                        </label>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
<script>
    let price = $(".fiyat").text();

    $(document).ready(function() {
        let globalCounter = $('.counter').text();
        let size = "Small";
        $('.arttiran').click(function() {
            globalCounter++;
            $('.counter').text(globalCounter);
            let sum = price * globalCounter;
            $('.fiyat').text(sum);
        });

        $('.azaltan').click(function() {
            if (globalCounter > 1) {
                globalCounter--;
                $('.counter').text(globalCounter);
                let sum = price * globalCounter;
                $('.fiyat').text(sum);
            }
        });
        let pizzaPrice = <?= $pizzaSmallPrice?>;

        $('input[name="radio"]').on('change', function() {
            let selectedSize = $('input[name="radio"]:checked').val();
            if (selectedSize === "small") {
                pizzaPrice = <?=$pizzaSmallPrice?>;
                size = "Small";
            } else if (selectedSize === "medium") {
                pizzaPrice = <?=$pizzaMediumPrice?>;
                size = "Medium";
            } else if (selectedSize === "large") {
                pizzaPrice = <?=$pizzaLargePrice?>;
                size = "Large";
            }
            
            price = pizzaPrice; 
            globalCounter = 1;
            $('.counter').text(globalCounter);
            $('.fiyat').text(price);
        });
        $('.cartbutton').click(function(){
            let quantity = globalCounter;
            globalCounter = 1;
            let productID = "<?= $price->pizza[0]['pizza_id']?>";
            let productPrice = pizzaPrice;
            let userid = <?=$_SESSION['user_id'] ?>
            

            let cart = [];
            cart.push({
                p_id: productID,
                p_price: productPrice,
                qty: quantity,
                p_size: size,
                removeding:selectedIngredients,
                userid:userid
            });
            console.log(cart);
            
            $.ajax({
                url: 'App/helpers/ajax.php', 
                method: 'POST',
            
                data: { cartget: JSON.stringify(cart) }, 
                success: function(response) {
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                    console.log(cart);
            
                    console.log("Ajax Başarılı");
                    console.log(response); 
                },
                error: function(xhr, status, error) {
                
                    console.error(error);
                }
            });
        })
        let selectedIngredients = []; 

        $('.ingredients-item').click(function() {
            let ingredient = $(this).text(); 


            if (selectedIngredients.includes(ingredient)) {
                var index = selectedIngredients.indexOf(ingredient);
                selectedIngredients.splice(index, 1);
            } else {
                selectedIngredients.push(ingredient); 
            }

            console.log(selectedIngredients); 
        });
        $(document).ready(function() {
            $(".ingredients-item").click(function() {
                $(this).toggleClass("line-through");
            });
        });
    });

</script>
<?php include 'footer.php' ?>
</body>
</html>