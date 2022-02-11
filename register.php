<?php
  if (isset($_POST['submit'])) {
    $jsonString = file_get_contents('data.json');
    $data = json_decode($jsonString, true);

    $bool;

    foreach($data as $user) {
      if ($_POST['username'] == $user['username'] || $_POST['email'] == $user['email']) {
        $bool = true;
      }
    }

    if (empty($bool)) {
      $id = $data[count($data) - 1]['id'];
      $data[$id]['id'] = $id + 1;
      $data[$id]['username'] = $_POST['username'];
      $data[$id]['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $data[$id]['email'] = $_POST['email'];
      
      $newJsonString = json_encode($data);
      file_put_contents('data.json', $newJsonString);
      
      header('Location: index.php');
    }

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/44bca1acc7.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Sign Up</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap');

    html * {
      padding: 0;
      margin: 0;
    }
    
    body {
      background-color: #6a62d2;
    }

    .login-form {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      width: 421px;
      background-color: #fafafa;
      border-radius: 6px;
      box-shadow: 0 0 5px #353535;
      <?php
        if (!empty($bool)) {
          echo 'height: 482px;';
        } else {
          echo 'height: 430px;';
        }
      ?>
    }

    .header-box {
      margin: 35px 0;
    }
    
    .header {
      font-family: 'Open Sans', sans-serif;
      color: #3b3b3b;
      font-weight: 600;
      text-shadow: 0 0 1px #353535;
      text-align: center;
      font-size: 20px;
      letter-spacing: 1.5px;
    }

    .warning {
      position: absolute;
      left: 10%;
      top: 19%;
      padding: 18px 0;
      width: 79.5%;
      background-color: #F2DEDE;
      color: #C6817F;
      border: 1px solid #C6817F;
      border-radius: 3px;
      font-family: 'Open Sans', sans-serif;
      text-align: center;
      font-size: 13px;
      z-index: 10;
      <?php
        if (!empty($bool)) {
          echo 'display: block;';
        } else {
          echo 'display: none;';
        }
      ?>
    }

    .input-box {
      position: relative;
      width: 80%;
      margin: 0 auto;
      <?php
        if (!empty($bool)) {
          echo 'top: 60px;';
        } else {
          echo '';
        }
      ?>
    }

    .input-box > input {
      width: calc(100% - 40px);
      height: 55px;
      margin-bottom: 12.5px;
      background-color: #E5E8ED;
      border: none;
      border-radius: 3.5px;
      padding: 0 20px;
    }

    .input-box > input:focus {
      outline: 2px solid #6a62d2;
    }

    .far {
      position: absolute;
      right: 25px;
      bottom: 30px;
      color: #757575;
      cursor: pointer;
      font-size: 18px;
    }

    ::-webkit-input-placeholder {
      font-size: 14.5px;
      font-family: 'Open Sans', sans-serif;
      font-weight: 500;
    }
    ::-moz-placeholder {
      font-size: 14.5px;
      font-family: 'Open Sans', sans-serif;
      font-weight: 500;
    }
    :-ms-input-placeholder { 
      font-size: 14.5px;
      font-family: 'Open Sans', sans-serif;
      font-weight: 500;
    }
    :-moz-placeholder { 
      font-size: 14.5px;
      font-family: 'Open Sans', sans-serif;
      font-weight: 500;
    }

    button {
      background-color: #746BDE;
      position: absolute;
      bottom: 62px;
      border: none;
      border-radius: 3.5px;
      width: 80%;
      left: 10%;
      height: 55px;
      color: white;
      font-family: 'Open Sans', sans-serif;
      font-size: 16.5px;
      font-weight: 500;
      letter-spacing: 1px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: #4f4896;
    }

    button[disabled] {
      background-color: #a29ce6;
      cursor: not-allowed;
    } 
    .redir {
      position: absolute;
      font-family: 'Open Sans', sans-serif;
      font-size: 12px;
      font-weight: 500;
      color: #757575;
      bottom: 27px;
      left: 50%;
      transform: translateX(-50%);
      cursor: pointer;
      font-weight: 600;
    }
    .redir > a {
      text-decoration: none;
      color: #6a62d2;
    }
    .redir > a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <form action="" method="POST" class="login-form">
      <div class="header-box">
        <h3 class="header">REGISTER NEW ACCOUNT</h3>
      </div>
      <div class="warning"><?php
        if (!empty($bool)) {
          echo 'Username or email already exist!';
        } else {
          echo 'Every fields must not be empty!';
        }
      ?></div>
      <div class="input-box">
        <input id="usernameInput" name="username" type="text" placeholder="Username">
        <br>
        <input id="emailInput" name="email" type="text" placeholder="Email">
        <br>
        <input id="passwordInput" name="password" type="password" placeholder="Password">
        <i class="far fa-eye" id=eye" onclick="showPassword(this)"></i>
      </div>
      <button id="signInBtn" name="submit" type="submit" disabled="disabled">REGISTER</button>
      <label class="redir">Already have an account? <a href="index.php">Log In</a></label>
    </form>
  </div>

  <script>

    $('input').keyup(function() {
      if (!(!$('#usernameInput').val() == '' && !$('#passwordInput').val() == '' && !$('#emailInput').val() == '')) {
        $('.warning').css({
          'display': 'block'
        });
        $('.warning').html('Every fields must not be empty!');
        $('.login-form').css({
          'height': '482px'
        });
        $('.input-box').css({
          'top': '60px'
        });
        $('#signInBtn').attr('disabled', 'disabled');
      } else {
        $('.warning').css({
          'display': 'none'
        });
        $('.login-form').css({
          'height': '430px'
        });
        $('.input-box').css({
          'top': '0'
        });
        $('#signInBtn').removeAttr('disabled');
      }
    });

    var passwordShow = false;

    function showPassword(x) {
      if (passwordShow) {
        x.classList.remove('fa-eye-slash');
        x.classList.add('fa-eye');
        $('#passwordInput').attr('type', 'password');
        passwordShow = false;
      } else {
        x.classList.remove('fa-eye');
        x.classList.add('fa-eye-slash');
        $('#passwordInput').attr('type', 'text');
        passwordShow = true;
      }
    }
  </script>
</body>
</html>