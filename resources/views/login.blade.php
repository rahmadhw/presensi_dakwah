<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Login System</title>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

    html,body,h1,h2,h3,h4,h5,h6,p,ul,li {
      padding: 0;
      margin: 0;
    }

    body {
      box-sizing: border-box;
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #2c2c6c;
      background-image: url("./assets/bgTexturn2.png");
      font-family: "Lucida grande", sans-serif;
    }

    .container {
      min-width: 400px;
      min-height: 450px;
      margin: auto;
      padding: 10px 10px;
      border-radius: 15px;
      color: #fff;
    }

    h2 {
      text-align: center;
      font-family: 'Poppins', sans-serif;
      text-transform: uppercase;
    }

    .container-title {
      font-family: 'Poppins', sans-serif;
      text-align: center;
    }

    .form-container {
      display: flex;
      flex-direction: column;
      margin-top: 60px;
    }

    .form-container-dua {
      display: flex;
      flex-direction: column;
      margin-top: 12px;
      position: relative;
    }

    .form-container-dua input {
      width: 98%;
      height: 40px;
      border: none;
      background-color: transparent;
      border-bottom: 2px solid #2c2c6c;
      color: #fff;
      font-size: 19px;
    }

    .form-container-dua .toggle-password {
      position: absolute;
      right: 10px;
      top: 35px;
      cursor: pointer;
      color: #aaa;
    }

    .form-container-dua .user,
    .form-container .user {
      font-size: 20px;
    }

    .form-container input {
      width: 98%;
      height: 40px;
      border: none;
      background-color: transparent;
      border-bottom: 2px solid #2c2c6c;
      color: #fff;
      font-size: 19px;
    }

    .tombol {
      margin-top: 40px;
      height: 150px;
    }

    .tombol button {
      width: 30%;
      height: 40px;
      background-color: #fff;
      border: none;
      color: #000;
      border-radius: 5px;
      cursor: pointer;
    }

    .tombol p {
      font-size: 15px;
      margin-top: 5px;
    }

    .login-sosmed {
      display: flex;
      justify-content: space-around;
      margin-top: 40px;
    }

    .login-sosmed button {
      font-family: 'Poppins', sans-serif;
      border-bottom: 2px solid #2c2c6c;
      background-color: transparent;
      color: #fff;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Selamat Datang</h2>
    <p class="container-title">Silakan Login</p>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-container">
        <label for="email" class="user">Email</label>
        <input type="email" id="email" placeholder="Input Username...." name="email">
      </div>

      <div class="form-container-dua">
        <label for="password" class="user">Password</label>
        <input type="password" id="password" placeholder="Input Password" name="password">
        <span class="toggle-password" onclick="togglePassword()">
          <i class="fas fa-eye" id="icon-eye"></i>
        </span>
      </div>

      <div class="tombol">
        <button type="submit">Log in</button>
      </div>
    </form>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const icon = document.getElementById("icon-eye");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
  </script>
</body>
</html>
