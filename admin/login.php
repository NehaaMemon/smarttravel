<?php
include 'db_connection.php';
if (isset($_POST['log'])) {
    $e = $_POST['email'];
    $p = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM `register` WHERE `email` = ? AND `password` = ?");
    $stmt->bind_param("ss", $e, $p);
    $stmt->execute();
    $result = $stmt->get_result();


    // Check if the result has exactly one row
    if ($result->num_rows === 1) {
        echo "<script>window.open('dashboard.php', '_self')</script>";
    } else {
        echo "<div class='alert alert-warning'><b>Error!</b> Wrong Email or Password.</div>";
    }

    // Close the statement
    $stmt->close();
}
?>


<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- favicon -->
      <link rel="icon" type="image/png" href="../assets/images/favicon.png">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="all">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="style.css">
      <title>Expense Voyague </title>
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
        <center><h4>Admin login Form</h4></center>
            <form class="login-from" method="POST">
                <h1 class="site-title">
                <a href="../index.php">

                       <img class="black-logo" src="assets/images/2.png" alt="logo" width="100%">
                   </a>
                </h1>
                <div class="form-group">
                    <label for="first_name1">User Name</label>
                    <input type="text" class="validate" name="email" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Password</label>
                    <input id="last_name" type="password" class="validate" name="password"   required>
                </div>
                <div class="form-group">
                    <button class="button-primary bbtn" name="log">Login</button>
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
