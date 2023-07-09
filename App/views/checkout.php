<?php
use App\controllers\OrderController;
require __DIR__."/../helpers/control.php";
$orderController = new OrderController();
$orderController->placeOrder();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include 'links.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
    .circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: gray;
        margin: auto;
        margin-top: 200px;
    }
    .waiting{
        background-color: gray;
    }
    .accepted{
        background-color: lightgreen;
    }
    .onway {
        background-color: orange;
    }
    .arrived{
        background-color: green;
    }
    
    .st{
        text-align: center;
        margin-top: 2rem;
        font-size: 60px;
        color: white;
    }
</style>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container">
        <div class="row text-center mt-5">
            <h1> Your Purchase Is Successful!</h1>
            <h3> Thank you for choosing us</h3>
            <h4> You can check your order in My Orders section</h4>
            <!-- <div class="circle"></div>
            <div class="st">Waiting</div> -->
        </div>
        <!-- <button class="btn primary-btn" id="next-button">İleri</button> -->
    </div>
    <script>
        // $(document).ready(function() {
        //     let Index = 0;
        //     let Dot = $(".circle");
        //     let st = $(".st");
            
        //     function updateProgressBar() {
        //         if(Index == 1){
        //             Dot.addClass('accepted');
        //             st.text("Accepted");
        //         }
        //         else if(Index == 2){
        //             Dot.addClass('onway');
        //             st.text("On Way");
        //         }
        //         else if(Index == 3){
        //             Dot.addClass('arrived');
        //             st.text("Arrived");
        //         }
        //         else if(Index == 0){
        //             Dot.addClass('waiting');
        //             st.text("Waiting");
        //         }
        //     }

        //     // İlerleme değerini değiştirmek için örnek bir olay dinleyicisi
        //     $('#next-button').click(function() {
        //         if (Index < 3) {
        //             Index++;
        //             updateProgressBar();
        //         }else{
        //             Index = 0;
        //         }
        //     });
        // });
        $(document).ready(function(){
            $(window).on('load', function(){
                setTimeout(function() {
                    window.location.href = 'home';
                }, 2000);
            });
        });

    </script>
          <?php include 'footer.php' ?>
</body>

</html>