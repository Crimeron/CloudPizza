<?php 
use App\controllers\AdminController;
$adminController = new AdminController();
$result = $adminController->getMembers();
?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content-wrapper">
    <div class="row">
        <div class="table-responsive col-lg-12">
            <table class="table table-bordered">
                <?= date('d-m-y H:i:s'); ?>
                <thead>
                    <tr>
                        <th>User ID</th>
                         <th>Name</th>
                         <th>Surname</th>
                         <th>Email</th>
                         <th>Password</th>
                         <th>Phone</th>
                         <th>Address</th>
                         <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $orderResult) {
                        echo '<tr>';
                        echo '<td>' . $orderResult['id'] . '</td>';
                        echo '<td>' . $orderResult['first_name'] . '</td>';
                        echo '<td>' . $orderResult['last_name'] . '</td>';
                        echo '<td>' . $orderResult['email'] . '</td>';
                        echo '<td>' . $orderResult['password'] . '</td>';
                        echo '<td>' . $orderResult['mobile'] . '</td>';
                        echo '<td>' . $orderResult['address'] . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-danger ml-5 delete">Sil</button>';
                        echo '</td>';
                        echo '</tr>';
                    } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>


<script>
        $(document).ready(function() {

            $(".delete").click(function(){
                let row = $(this).closest('tr');
                let userId = row.find('td:eq(0)').text();
                console.log(userId);
                $.ajax({
                    url: 'App/helpers/ajax.php',
                    method: 'POST',
                    data: {
                        userID:userId
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



