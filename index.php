<?php
require('./php/function.php');
session_start();
if (isset($_SESSION['username'])) {
  header("location: ./production/table_data_dak_satu.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST["username"]) && isset($_POST["password"])) {
    if (LoginAdmin($_POST) == true) {
      $_SESSION['username'] = $_POST['username'];
      header("location: ./production/table_data_dak_satu.php");
    } else {
      echo '<script language="javascript">';
      echo 'alert("Username Atau Password Anda Salah")';
      echo '</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Gentelella Alela! | </title>

  <!-- Bootstrap -->
  <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="./vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="./build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form action="index.php" method="POST">
            <h1>Login Form</h1>
            <div>
              <input type="text" class="form-control" name="username" placeholder="Username" required="" />
            </div>
            <div>
              <input type="password" class="form-control" name="password" placeholder="Password" required="" />
            </div>
            <div>
              <button class="btn btn-info submit" type="submit" style="text-decoration: none;">Log in</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">


              <div class="clearfix"></div>
              <br />

              <div>
                <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>

</html>