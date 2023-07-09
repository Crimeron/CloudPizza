<?php
require __DIR__."/../helpers/control.php";
if (isset($_GET['logout'])) {
   session_destroy();
   header("location: home");
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
    <style>

    .form-container {
        display: flex;
        flex-direction: column;
        width: 400px !important; /* İstediğiniz genişliği burada belirleyebilirsiniz */
        margin: auto;
    }

    .input-box {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        background-color: white;
        color: black;
        padding: 1rem;
        border: 1px solid black;
        border-radius: 1rem;
    }

    .input-box input,
    .input-box textarea {
        flex: 1;
        width: 100%;
    }
    .input-label{
        background-color: white;
        color: black;
        padding: 1rem;

    }
    </style>
    <div class="container">
    <form class="form-container mt-5" id="update-form">
    <div id="messageBox" class="alert alert-danger" style="display: none;"></div>
    <div class="input-box">
        <label for="first-name" id="first-name-label" class="input-label mx-4">Name</label>
        <input type="text" id="firstName" name="firstName" minlength="3" required="" value="<?= $data[0]['user_firstname'] ?>">
    </div>
    <div class="input-box">
        <label for="lastName" id="lastName-label" class="input-label">Surname</label>
        <input type="text" id="lastName" name="lastName" minlength="3" required="" value="<?= $data[0]['user_lastname'] ?>">
    </div>
    <div class="input-box">
        <label for="mobile-number" id="mobile-number-label" class="input-label">Phone Number</label>
        <input type="tel" id="mobile-number" name="mobileNumber" placeholder=" " class="valid" required="" minlength="7" value="<?= $data[0]['user_mobile'] ?>">
    </div>
    <div class="input-box">
        <label class="input-group-text input-label">Address</label>
        <textarea class="form-control" name="address" minlength="10" style="height: 10rem" aria-label="With textarea"><?= $data[0]['user_address'] ?></textarea>
    </div>
    <div class="box-flex as-end">
        <button class="btn btn-success" style=" display:flex; margin:auto" type="button" id="update-button">Save</button>
    </div>
    <a href="?logout" class="btn btn-warning" style=" display:flex; margin:auto; margin-top:2rem; color:white">Logout</a>
</form>

    </div>

    <script>
    $(document).ready(function() {
        $('#update-button').click(function() {
            let firstName = $('#firstName').val();
            let lastName = $('#lastName').val();
            let mobileNumber = $('#mobile-number').val();
            let address = $('textarea[name="address"]').val();
            let userid = <?php echo $_SESSION['user_id']; ?>;
            let save = 'true';
            $.ajax({
                url: 'App/helpers/form.php',
                method: 'POST',
                data: {
                    firstName: firstName,
                    lastName: lastName,
                    mobile: mobileNumber,
                    address: address,
                    userid: userid,
                    save: save
                },
                success: function(response) {
                    console.log(response);
                    response = JSON.parse(response);
                    if (response.status === 'success') {
                        setTimeout(function() {
                            window.location.href = 'profile';
                        }, 2000);
                        $('#messageBox').removeClass('alert-danger').addClass('alert-success');
                        $('#messageBox').text("Veriniz Başarıyla Değişti!").show();
                    } else {
                        $('#messageBox').removeClass('alert-success').addClass('alert-danger');
                        $('#messageBox').text(response.message).show();
                    }
                }

            });
        });
    });
    </script>
          <?php include 'footer.php' ?>
</body>
</html>