<?php 
use App\controllers\AdminController;
use App\controllers\OrderController;
$adminController = new AdminController();
$result = $adminController->getOrders();
if(isset($_GET['orderid'])){
    $orderID = $_GET['orderid'];
    $OrderController = new OrderController();
    $orderDetails = $OrderController->getOrderDetails($orderID);
}else{
    $orderDetails = [];
}

?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content-wrapper col-lg-12">
    <div class="row">
        <div class="col-md-4">
            <form action="" id="manage-menu">
                <div class="card">
                    <div class="card-header">
                        Order Form
                    </div>
                    <div class="card-body">
                    <h2>Order Details</h2>
                <table style="margin:auto" class="table table-bordered col-lg-5">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Size(If Available)</th>
                            </tr>
                        </thead>
                        <?php foreach ($orderDetails as $orderResult) {
                        echo '<tr>';
                        echo '<td>' . $orderResult['order_id'] . '</td>';
                        echo '<td>' . $orderResult['user_id'] . '</td>';
                        echo '<td>' . $orderResult['p_name'] . '</td>';
                        echo '<td>' . $orderResult['p_price'] . '</td>';
                        echo '<td>' . $orderResult['size'] . '</td>';
                        echo '</tr>';
                        
                    }?>
                    </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-sm btn-success col-sm-6 offset-md-3 apply">Save</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <div class="filter-container">
    <label for="status-filter">Filter by Status:</label>
    <select id="status-filter">
        <option value="All">All</option>
        <option value="Onay Bekliyor">Waiting for apply</option>
        <option value="Onaylandı">Applied</option>
        <option value="Yolda">On way</option>
        <option value="Başarılı">Succesfull</option>
    </select>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $orderResult) {
            $status = $orderResult['status'];
            $display = true;

            if (isset($_GET['status'])) {
                $filterStatus = $_GET['status'];
                if ($filterStatus != $status) {
                    $display = false;
                }
            }

            if ($display) {
                echo '<tr>';
                echo '<td>' . $orderResult['id'] . '</td>';
                echo '<td>' . $orderResult['user_id'] . '</td>';
                echo '<td>' . $orderResult['first_name'] . '</td>';
                echo '<td>' . $orderResult['last_name'] . '</td>';
                echo '<td>' . $orderResult['address'] . '</td>';
                echo '<td>' . $orderResult['mobile'] . '</td>';
                echo '<td>' . $orderResult['status'] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-success view-order" href="admin?pages=orders&orderid=' . $orderResult['id'] . '">Siparişi Görüntüle</a>';
                echo '<button class="btn btn-danger ml-5 delete">Sil</button>';
                echo '</td>';
                echo '</tr>';
            }
        } ?>
    </tbody>
</table>


</div>
</div>
</div>
</div>
</div>
</div>


<script>
$(document).ready(function() {
    let selectedStatus = '<?php echo isset($_GET["status"]) ? $_GET["status"] : "All"; ?>';
    $('#status-filter').val(selectedStatus);

    $('#status-filter').change(function() {
        var selectedStatus = $(this).val();
        var url = 'admin?pages=orders';
        if (selectedStatus !== 'All') {
            url += '&status=' + selectedStatus;
        }
        window.location.href = url;
    });
});



</script>
<script>
        $(document).ready(function() {

            $(".view-order").click(function() {
                var orderId = $(this).data("order-id");
                $("#orderId").text(orderId);
                // Burada sipariş ID'sine göre diğer verileri çekebilir ve modal içinde gösterebilirsiniz
            });

            $(".delete").click(function(){
                let row = $(this).closest('tr');
                let userID = row.find('td:eq(1)').text();
                console.log(userID);
                $.ajax({
                    url: 'App/helpers/ajax.php',
                    method: 'POST',
                    data: {
                        userId:userID
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
            $(".apply").click(function(){
                let orderID = <?=$_GET['orderid']?>;
                let statusUpdate = "Apply";
                console.log(orderID);
                $.ajax({
                    url: 'App/helpers/ajax.php',
                    method: 'POST',
                    data: {
                        orderId:orderID,
                        StatusUpdate:statusUpdate
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
    });
        

</script>



