<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <?php include_once 'links.php' ?>
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
        <h1 class="card-title">Admin Login</h1>
        <form>
          <div class="mb-3">
            <label for="loginUserName" class="form-label">Username</label>
            <input type="email" class="form-control" id="loginUserName" name="loginEmail" required>
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
          </div>
          <button class="btn btn-primary" id="login">Login</button>
        </form>
        <div id="messageBox" class="alert alert-danger" style="display: none;"></div> <!-- Uyarı kutusu -->
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
    $('#login').click(function(event) {
      event.preventDefault(); // Sayfanın yeniden yüklenmesini önlemek için formun varsayılan davranışını engelle

      let userName = $('#loginUserName').val();
      let password = $('#loginPassword').val();
      let isAdmin = 1;

      $.ajax({
        url: 'App/helpers/form.php',
        method: 'POST',
        data: { 
          username: userName, 
          password: password,
          isAdmin: isAdmin,
        },
        success: function(response) {
          if (response == '2') {
              setTimeout(function() {
                window.location.href = 'admin';
              }, 2000);
              $('#messageBox').removeClass('alert-danger').addClass('alert-success');
              $('#messageBox').text("Giriş Başarılı Hoş Geldiniz!").show();
            } else if(response == '1') {
              // Hata durumu
              $('#messageBox').text("Kullanıcı adı ya da Şifreniz yanlış").show(); // Uyarı mesajını göster
              console.log(response);
            }
            else{
              $('#messageBox').text("Kullanıcı bulunamadı").show();
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
</body>
</html>
