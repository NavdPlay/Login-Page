<?php
$bool1 = false;
$bool2 = false;
  if (isset($_POST['submit'])) {
    $jsonString = file_get_contents('data.json');
    $data = json_decode($jsonString, true);

    $length = count($data);
    $i = 0;

    for ($i; $i < $length; $i++) {
      if ($_POST['username'] == $data[$i]['username'] || $_POST['username'] == $data[$i]['email']) {
        if (password_verify($_POST['password'], $data[$i]['password'])) {
          header('Location: success.html');
          break;
        } else {
          $bool1 = true;
          break;
        }
      }
    }
    if ($i >= $length) {
      $bool2 = true;
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
  <title>Sign In</title>
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
        if ($bool1 || $bool2) {
          echo 'height: 482px;';
        } else {
          echo 'height: 413px;';
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
      <?php
        if ($bool1 || $bool2) {
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
        if ($bool1 || $bool2) {
          echo 'top: 55px;';
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
      bottom: -117px;
      border: none;
      border-radius: 3.5px;
      width: 100%;
      left: 0;
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

    .forgot {
      position: absolute;
      font-family: 'Open Sans', sans-serif;
      font-size: 12px;
      font-weight: 500;
      color: #757575;
      left: 50%;
      transform: translateX(-50%);
      cursor: pointer;
      <?php
        if ($bool1 || $bool2) {
          echo 'bottom: 157px;';
        } else {
          echo 'bottom: 149px;';
        }
      ?>
    }
    .forgot:hover {
      text-decoration: underline;
    }
    .redir {
      position: absolute;
      font-family: 'Open Sans', sans-serif;
      font-size: 12px;
      font-weight: 500;
      color: #757575;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%);
      cursor: pointer;
      font-weight: 600;
      width: 200px;
    }
    .redir > a {
      position: relative;
      left: 3px;
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
    <div class="login-form">
      <div class="header-box">
        <h3 class="header">SIGN IN TO YOUR ACCOUNT</h3>
      </div>
      <div class="warning">
        <?php
          if ($bool1) {
            echo 'Password or Username invalid!';
          } else if ($bool2) {
            echo 'User not found!';
          } else {
            echo 'Every fields must not be empty!';
          }
        ?>
      </div>
      <form class="input-box" method="POST">
        <input id="usernameInput" type="text" name="username" placeholder="Username or Email">
        <br>
        <input id="passwordInput" type="password" name="password" placeholder="Password">
        <i class="far fa-eye" id=eye" onclick="showPassword(this)"></i>
        <button id="signInBtn" name="submit" disabled="disabled">SIGN IN</button>
      </form>
      <label class="forgot">Forgot your password?</label>
      <label class="redir">Don't have an account yet?<a href="register.php">Sign Up</a></label>
    </div>
  </div>

  <script>

    $('input').keyup(function() {
      if (!(!$('#usernameInput').val() == '' && !$('#passwordInput').val() == '')) {
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
        $('.forgot').css({
          'bottom': '157px'
        });
      } else {
        $('.warning').css({
          'display': 'none'
        });
        $('.login-form').css({
          'height': '413px'
        });
        $('.input-box').css({
          'top': '0'
        });
        $('#signInBtn').removeAttr('disabled');
        $('.forgot').css({
          'bottom': '149px'
        });
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
