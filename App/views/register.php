<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <?php include 'links.php' ?>
  <style>
    html, body {
      height: 100%;
    }

    .d-flex {
      align-items: center;
      justify-content: center;
      height: 100%;
    }

    .card {
      width: 400px;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title">Register</h1>
        <form>
          <div class="mb-3">
            <label for="firstName" class="form-label">Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
          </div>
          <div class="mb-3">
            <label for="lastName" class="form-label">Surname</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="mobile" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="mobile" name="mobile" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
          </div>
          <button id="register" class="btn btn-primary">Register</button>
        </form>
        <p>Already a member? <a href="login">Login</a></p>
        <div id="messageBox" class="alert alert-danger" style="display: none;"></div> <!-- Uyarı kutusu -->
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#register').click(function(event) {
        event.preventDefault(); // Sayfanın yeniden yüklenmesini önlemek için formun varsayılan davranışını engelle

        let firstName = $('#firstName').val();
        let lastName = $('#lastName').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let mobile = $('#mobile').val();
        let address = $('#address').val();
        let register = 1;

        $.ajax({
          url: 'App/helpers/form.php',
          method: 'POST',
          data: { 
            firstName: firstName,
            lastName: lastName,
            email: email, 
            password: password,
            mobile: mobile,
            address: address,
            register: register,
          },
          success: function(response) {
            if (response == 'Aramıza Hoş Geldiniz') {
              setTimeout(function() {
                window.location.href = 'login';
              }, 2000);
              $('#messageBox').removeClass('alert-danger').addClass('alert-success');
              $('#messageBox').text(response).show();
            } else {
              // Hata durumu
              $('#messageBox').text(response).show(); // Uyarı mesajını göster
              console.log(response);
            }
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
        });
      });
    });
  </script>
        <?php include 'footer.php' ?>
</body>
</html>
