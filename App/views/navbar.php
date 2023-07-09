<?php
use App\controllers\CartController;
$cartController = new CartController();
$cartController->loadCart();
$cartdatas =  $cartController->cart;
$sum = 0;
$qty = 0;
foreach ($cartdatas as $cartdata) {
    $sum += $cartdata['total_price'];
    $qty += $cartdata['product_qty'];
}
?>
<div class="headerbg">
        <div class="container">
           <nav class="navbar navbar-expand-lg">
               <div class="container-fluid">
                   <a class="navbar-brand" href="home">
                       <img src="Public/assets/img/Logo/Logo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
                   </a>
                   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="navbar-toggler-icon"></span>
                   </button>
                   <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                       <ul class="navbar-nav">
                           <li class="nav-item">
                               <a class="nav-link" href="home">HOME</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" href="products">PRODUCTS</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" href="aboutus">ABOUT US</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" href="orders">ORDERS</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" href="contact">CONTACT</a>
                           </li>
                           <li class="nav-item">
                                <a class="nav-link" href="cartlist" style="display: flex; align-items: center;">
                                    <i class="fa-solid fa-cart-shopping" style="margin-right: 6px;"></i>
                                    <div id="addtocart"><?=$qty?> CART - <?=$sum?>$</div>
                                </a>
                            </li>
                            <li class="nav-item">
                               <a class="nav-link" href="profile"><i class="fa-solid fa-user"></i></a>
                           </li>
                       </ul>
                   </div>
               </div>
           </nav>
        </div>
    </div>