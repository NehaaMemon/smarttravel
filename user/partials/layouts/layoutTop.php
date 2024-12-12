<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<?php include
'./partials/head.php';
error_reporting(0);
include 'dp.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }
  echo "Connected successfully";


 ?>

<body>

    <?php include './partials/sidebar.php' ?>

    <main class="dashboard-main">
    <?php include './partials/navbar.php' ?>

        <div class="dashboard-main-body">

            <?php include './partials/breadcrumb.php' ?>
