<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
use App\controllers\AdminController;
use App\controllers\PizzaController;

    $adminController = new AdminController();
    $result = $adminController->getPizzas();
    if(isset($_GET['pizzaid'])){
        $pizzaID = $_GET['pizzaid'];
        $adminController = new AdminController();
        $pizzaDetails = $adminController->getPizzaDetails($pizzaID);
    }else{
        $pizzaDetails = [];
    }
?>

<div class="content-wrapper col-lg-12">
    <div class="row">
        <div class="col-md-4">
            <form id="manage-menu" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        Pizza Form
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="control-label">Pizza Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo isset($pizzaDetails[0]['name']) ? $pizzaDetails[0]['name'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pizza Description</label>
                            <textarea cols="30" rows="3" class="form-control" name="description"><?php echo isset($pizzaDetails[0]['description']) ? $pizzaDetails[0]['description'] : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" class="custom-control-input" id="availability" <?php echo isset($pizzaDetails[0]['status']) && $pizzaDetails[0]['status'] == '1' ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="availability">Availability</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Small Size Price</label>
                            <input type="number" class="form-control text-right" name="price_small" step="any" value="<?php echo isset($pizzaDetails[0]['small']) ? $pizzaDetails[0]['small'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Medium Size Price</label>
                            <input type="number" class="form-control text-right" name="price_medium" step="any" value="<?php echo isset($pizzaDetails[0]['medium']) ? $pizzaDetails[0]['medium'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Large Size Price</label>
                            <input type="number" class="form-control text-right" name="price_large" step="any" value="<?php echo isset($pizzaDetails[0]['large']) ? $pizzaDetails[0]['large'] : ''; ?>">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-primary col-sm-3 offset-md-3" id="save"> Save</button>
                                <a class="btn btn-sm btn-default col-sm-3" href="admin?pages=pizzas"> Cancel</a>
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
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Product ID</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Product Description</th>
                                <th class="text-center">Relevance</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $pizzaResult) {
                                echo '<tr>';
                                echo '<td>' . $pizzaResult['pizza_id'] . '</td>';
                                echo '<td>' . $pizzaResult['pizza_name'] . '</td>';
                                echo '<td>' . $pizzaResult['pizza_description'] . '</td>';
                                echo '<td>' . $pizzaResult['pizza_price'] . '</td>';
                                echo '<td>' . $pizzaResult['pizza_status'] . '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-success view-order" href="admin?pages=pizzas&pizzaid=' . $pizzaResult['pizza_id'] . '">View Pizza</a>';
                                echo '<button class="btn btn-danger ml-5 delete">Delete</button>';
                                echo '</td>';
                                echo '</tr>';
                            }?>
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
        $(".delete").click(function() {
            var row = $(this).closest("tr");
            var id = row.find("td:first").text();
            console.log(id);
            $.ajax({
                url: "App/helpers/ajax.php",
                type: "POST",
                data: { id: id },
                success: function(response) {
                    console.log(response);
                    row.remove();
                },
                error: function(xhr, status, error) {
                    console.log("Silme işlemi başarısız: " + error);
                }
            });
        });

        $('#save').click(function(event) {
                event.preventDefault();
                let pizzaid = <?= isset($_GET['pizzaid']) ? $_GET['pizzaid'] : 'null' ?>;
                let name = $('input[name="name"]').val();
                let description = $('textarea[name="description"]').val();
                let status = $('#availability').prop('checked') ? '1' : '0';
                let price_small = $('input[name="price_small"]').val();
                let price_medium = $('input[name="price_medium"]').val();
                let price_large = $('input[name="price_large"]').val();
                if(price_small < 0){
                    price_large = 0;
                }else if(price_medium < 0){
                    price_medium = 0;
                }
                else if(price_large < 0){
                    price_large = 0;
                }
                let pizzasave = 'true';
                let pizzaupdate = <?= isset($_GET['pizzaid']) ? 'true' : 'false' ?>;

                $.ajax({
                    url: 'App/helpers/form.php',
                    type: 'POST',
                    data: {
                        pizzaID:pizzaid,
                        name: name,
                        description: description,
                        status: status,
                        price_small: price_small,
                        price_medium: price_medium,
                        price_large: price_large,
                        pizzasave: pizzasave,
                        pizzaupdate: pizzaupdate
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log('İstek gönderilirken bir hata oluştu: ' + error);
                    }
                });
            });

    });

</script>