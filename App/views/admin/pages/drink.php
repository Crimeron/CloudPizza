<?php
use App\controllers\AdminController;
$adminController = new AdminController();
$result = $adminController->getProduct('3');
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="content-wrapper col-lg-12">
    <div class="row">
        <div class="col-md-4">
            <form>
            <div class="card">
                    <div class="card-header">
                        Drink Form
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="control-label">Product Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Product Description</label>
                            <textarea cols="30" rows="3" class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" class="custom-control-input" id="availability" checked>
                                <label class="custom-control-label" for="availability">Availability</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="number" class="form-control text-right" name="price" step="any">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-primary col-sm-3 offset-md-3" id= "save">Kaydet</button>
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
                                    echo '<td>' . $pizzaResult['p_id'] . '</td>';
                                    echo '<td>' . $pizzaResult['name'] . '</td>';
                                    echo '<td>' . $pizzaResult['description'] . '</td>';
                                    echo '<td>' . $pizzaResult['status'] .
                                    '<button class="btn btn-success ml-5 status" >Uygunluk Değiştir</button>'; 
                                    '</td>';
                                    echo '<td>' . $pizzaResult['price'] . '</td>';
                                    echo '<td>';
                                    echo '<button class="btn btn-danger ml-5 delete" >Sil</button>';
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
            var id = row.find('td:eq(0)').text();
            console.log(id);
            $.ajax({
                url: "App/helpers/ajax.php",
                type: "POST",
                data: { productID: id },
                success: function(response) {
                    console.log(response);
                    row.remove();
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log("Silme işlemi başarısız: " + error);
                }
            });
        });
        $(".status").click(function() {
            var row = $(this).closest("tr");
            var id = row.find('td:eq(0)').text();
            let status = '1';
            console.log(id);
            $.ajax({
                url: "App/helpers/ajax.php",
                type: "POST",
                data: { 
                    productid: id,
                    status:status
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log("Uygunluk Değiştirilemedi: " + error);
                }
            });
        });
        $('#save').click(function(event) {
            event.preventDefault();
            let name = $('input[name="name"]').val();
            let description = $('textarea[name="description"]').val();
            let status = $('#availability').prop('checked') ? '1' : '0';
            let price = $('input[name="price"]').val();
            let productsave = 'true';
            let categoryID = '3';

            $.ajax({
                url: 'App/helpers/form.php',
                type: 'POST',
                data: {
                    name: name,
                    description: description,
                    status: status,
                    price: price,
                    productSave: productsave,
                    categoryId: categoryID
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