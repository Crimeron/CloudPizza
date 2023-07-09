<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
    <div class="card animate-slide-up">
      <div class="card-body">
        <h1 class="card-title">Member Login</h1>
        <form>
          <div class="mb-3">
            <label for="loginEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="loginEmail" name="loginEmail" required>
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
          </div>
          <button class="btn btn-primary" id="login">Login</button>
        </form>
        <p class="mt-4">Not a Member? <a href="register">Register</a></p>
        <div id="messageBox" class="alert alert-danger" style="display: none;"></div> <!-- Uyarı kutusu -->
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
    $('#login').click(function(event) {
      event.preventDefault();

      let mail = $('#loginEmail').val();
      let password = $('#loginPassword').val();
      let login = 1;

      $.ajax({
        url: 'App/helpers/form.php',
        method: 'POST',
        data: { 
          email: mail, 
          password: password,
          login: login,
        },
        success: function(response) {
          if (response == '2') {
              setTimeout(function() {
                window.location.href = 'products';
              }, 2000);
              $('#messageBox').removeClass('alert-danger').addClass('alert-success');
              $('#messageBox').text("Login Successful Welcome!").show();
            } else if(response == '1') {
              $('#messageBox').text("Your Email or Password is incorrect").show(); 
              console.log(response);
            }
            else{
              $('#messageBox').text("User not found").show();
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
