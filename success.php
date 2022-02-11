<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/44bca1acc7.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Login Succesful</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap');

    html * {
      padding: 0;
      margin: 0;
    }

    body {
      background-color: #6a62d2;
    }

    .container {
      position: relative;
    }

    .jumbotron {
      position: absolute;
      width: 100%;
      height: 55vh;
      background-color: white;
      box-shadow: 0 1px 5px #3b3775;
    }

    .triangle {
      position: absolute;
      left: 50%;
      top: 55vh;
      transform: translate(-50%, 0);
      height: 0;
      width: 0;
      border-left: 60px solid transparent;
	    border-right: 60px solid transparent;
	    border-top: 60px solid #fff;
    }

    .fas {
      position: absolute;
      left: 50%;
      top: 12%;
      transform: translate(-50%, 0);
      color: #6a62d2;
      font-size: 150px;
    }

    h1 {
      position: absolute;
      left: 50%;
      top: 65%;
      transform: translate(-50%, 0);
      font-size: 40px;
      font-family: 'Open Sans', sans-serif;
      color: #3d3d74;
    }

    button {
      position: absolute;
      bottom: -55%;
      left: 50%;
      transform: translate(-50%, 0);
      background-color: white;
      border: none;
      font-family: 'Open Sans', sans-serif;
      color: #6a62d2;
      padding: 10px 25px;
      font-size: 20px;
      border-radius: 15px;
      cursor: pointer;
      transition: 0.3s;
      font-weight: bold;
    }

    button:hover {
      background-color: #d9d8ed;
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="jumbotron">
      <i class="fas fa-check-circle"></i>
      <h1>Login succesful!</h1>
      <button>Redirect to sign in page</button>
    </div>
    <div class="triangle"></div>
  </div>

  <script>
    $('button').click(function() {
      location.replace('index.php');
    });
  </script>
</body>
</html>