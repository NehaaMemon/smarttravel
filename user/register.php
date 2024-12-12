<?php
include 'db.php';
if (isset($_POST['register'])) {
    $n = $_POST['fn'];
    $e = $_POST['email'];
    $p = $_POST['ps'];

    $q1 = "SELECT * FROM `register` WHERE `email` LIKE '$e'";
    $run = mysqli_query($con, $q1);
    $count = mysqli_num_rows($run);

    if ($count == 1) {
        echo '<script>alert("Already Registered!!");</script>';
        echo '<script>window.location.href="login.php";</script>';
        exit();  // Stop execution to allow the alert to be shown
    } else {
        $q = "INSERT INTO `register`(`name`,`email`,`password`) VALUES ('$n','$e','$p')";
        mysqli_query($con, $q);
        echo '<script>alert("Registration Successful!");</script>';
        echo '<script>window.location.href="login.php";</script>';
        exit();  // Stop execution to allow the alert to be shown
    }
}
?>




<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- favicon -->
      <link rel="icon" type="image/png" href="assets/images/favicon.png">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="all">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="style.css">
      <title>Expense Voyague</title>
      <style>
        .bbtn{
            border-color: #0791BE !important;

            border-bottom: #0791BE;
        }
        </style>
</head>
<body>
    <div class="login-page" style="background-image: url(assets/images/bg.jpg);">
        <div class="login-from-wrap">
            <form method="POST" class="login-from">
                <h1 class="site-title">
                    <a href="#">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                </h1>
               <center><h4>User Register Form</h4></center>
                <div class="form-group">
                    <label for="first_name1">User Name</label>
                    <input type="text" class="validate" required name="fn">
                </div>
                <div class="form-group">
                    <label for="first_name1">Email</label>
                    <input type="email" class="validate" required name="email">
                </div>


                <div class="form-group">
                    <label for="last_name">Password</label>
                    <input id="last_name" type="password" class="validate" required name="ps">
                </div>

                <div class="form-group">
                   <button class="button-primary bbtn" name="register">Register</button>
                </div>
                <!-- <a href="forgot.html" class="for-pass">Forgot Password?</a> -->
            </form>
        </div>
    </div>

    <!-- *Scripts* -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/canvasjs.min.js"></script>
    <script src="assets/js/counterup.min.js"></script>
    <script src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/dashboard-custom.js"></script>
</body>
</html>
