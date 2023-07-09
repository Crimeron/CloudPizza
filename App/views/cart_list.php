<?php
require __DIR__."/../helpers/control.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include 'links.php' ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container mt-5">
    <div class="row">
        <div class="col-lg-9">
            <div class="cart_products">
                <table class="table" style="color: white;">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Price(s)</th>
                            <th>Amount</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($data as $datap) : ?>
    <tr>
        <td><?= $datap['product_name']; ?></td>
        <td><?= $datap['product_size']; ?></td>
        <td><?= $datap['p_price']; ?></td>
        <td>
            <input type="number" class="form-control quantity" value="<?= $datap['product_qty']; ?>">
        </td>
        <td class="total_price"><?= $datap['total_price']; ?></td>
        <td>
            <button class="btn btn-danger">Sil</button>
        </td>
    </tr>
    <script>
        $(document).ready(function(){
            $(".quantity").change(function() {
                let quantity = $(this).val();

                if (quantity <= 0) {
                    $(this).val(1);
                    quantity = 1; 
                }
                let row = $(this).closest('tr');
                let productName = row.find('td:eq(0)').text();
                let price = $(this).closest('tr').find('td:nth-child(3)').text();
                let sum = price * quantity;
                $(this).closest('tr').find('.total_price').text(sum);
                $.ajax({
                url: 'App/helpers/ajax.php',
                method: 'POST',
                data: {
                    quantity: quantity,
                    sum: sum,
                    productName:productName
                },
                success: function(response) {
                    location.reload();
                    console.log(response); 
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            });

            $(".btn-danger").click(function(){
            let row = $(this).closest('tr');
            let productName = row.find('td:eq(0)').text();
            let pPrice = row.find('td:eq(2)').text();
            $.ajax({
                url: 'App/helpers/ajax.php',
                method: 'POST',
                data: {
                    productName: productName,
                    pPrice: pPrice
                },
                success: function(response) {
                    location.reload();
                    console.log(response); 
                    row.remove();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        });
        });
    </script>
    <?php endforeach; ?>
</tbody>

                </table>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="cart_payment">
                <h4>Total Cart</h4>
                <p>Total Product<?=$qty?></span></p>
                <p>Total Amount: <?=$sum?> $</span></p>
                <hr>
                    <a class="btn btn-primary" href="checkout">Buy</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
</body>
</html>