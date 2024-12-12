<?php
include 'db.php';
error_reporting(0);
  $e = $_SESSION['email'];
//   echo $e;
  $q = "SELECT * FROM `register` WHERE `email`='$e'";
  $row = mysqli_query($con, $q);
  $data = mysqli_fetch_assoc($row);
  $_SESSION['id'] = $data['id'];
  $_SESSION['email'] = $data['email'];
  $_SESSION['name'] = $data['name'];
//  echo $_SESSION['id'];




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
      <title> Expense Voyage  </title>
</head>
<body>

    <!-- start Container Wrapper -->
    <div id="container-wrapper">
        <!-- Dashboard -->
        <div id="dashboard" class="dashboard-container">
            <div class="dashboard-header sticky-header">
                <div class="content-left  logo-section pull-left">
                    <h1><a href="../index.php"><img src="assets/images/logo.png" alt=""></a></h1>
                </div>
                <div class="heaer-content-right pull-right">
                    <div class="search-field">
                        <form method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search" placeholder="Search Now" name="sear">
                               <a href=""> <span class="search_btn"><i class="fa fa-search" aria-hidden="true" name="search"></i></span></a>
                            </div>
                        </form>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" id="notifyDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- <div class="dropdown-item">
                                <i class="far fa-envelope"></i>
                                <span class="notify">3</span>
                            </div> -->
                        </a>
                        <div class="dropdown-menu notification-menu" aria-labelledby="notifyDropdown">
                            <!-- <h4> 3 Notifications</h4>
                            <ul> -->
                                <!-- <li>
                                    <a href="#">
                                        <div class="list-img">
                                            <img src="assets/images/comment.jpg" alt="">
                                        </div>
                                        <div class="notification-content">
                                            <p>You have a notification.</p>
                                            <small>2 hours ago</small>
                                        </div>
                                    </a>
                                </li> -->
                                <!-- <li>
                                    <a href="#">
                                        <div class="list-img">
                                            <img src="assets/images/comment2.jpg" alt="">
                                        </div>
                                        <div class="notification-content">
                                            <p>You have a notification.</p>
                                            <small>2 hours ago</small>
                                        </div>
                                    </a>
                                </li> -->
                                <!-- <li>
                                    <a href="#">
                                        <div class="list-img">
                                            <img src="assets/images/comment3.jpg" alt="">
                                        </div>
                                        <div class="notification-content">
                                            <p>You have a notification.</p>
                                            <small>2 hours ago</small>
                                        </div>
                                    </a>
                                </li> -->
                            <!-- </ul> -->
                            <!-- <a href="#" class="all-button">See all messages</a> -->
                        </div>
                    </div>
                    <!-- <div class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <div class="dropdown-item">
                                <i class="far fa-bell"></i>
                                <span class="notify">3</span>
                            </div>
                        </a>
                        <div class="dropdown-menu notification-menu">
                            <h4> 3 Messages</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <div class="list-img">
                                            <img src="assets/images/comment4.jpg" alt="">
                                        </div>
                                        <div class="notification-content">
                                            <p>You have a notification.</p>
                                            <small>2 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="list-img">
                                            <img src="assets/images/comment5.jpg" alt="">
                                        </div>
                                        <div class="notification-content">
                                            <p>You have a notification.</p>
                                            <small>2 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="list-img">
                                            <img src="assets/images/comment6.jpg" alt="">
                                        </div>
                                        <div class="notification-content">
                                            <p>You have a notification.</p>
                                            <small>2 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <a href="#" class="all-button">See all messages</a>
                        </div>
                    </div> -->
                    <div class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <div class="dropdown-item profile-sec">
                            <?php
// Include this code inside your header where the profile image is to be displayed

// Check if the image is set in the session and display it
if (isset($_SESSION['img']) && !empty($_SESSION['img'])) {
    // Display the user's profile image
    echo '<img src="' . $_SESSION['img'] . '" alt="User Profile" />';
} else {
    // If no image is available, display a default image
    echo '<img src="assets/images/person.png" alt="Default Profile" />';
}
?>

                                <span><?php echo $_SESSION['name'];?></span>
                                <i class="fas fa-caret-down"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu account-menu">
                            <ul>
                                <!-- <li><a href="#"><i class="fas fa-cog"></i>Settings</a></li> -->
                                <li><a href="profile-u.php"><i class="fas fa-user-tie"></i>Profile</a></li>

                                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-navigation">
                <!-- Responsive Navigation Trigger -->
                <div id="dashboard-Navigation" class="slick-nav"></div>
                <div id="navigation" class="navigation-container">
                    <ul>
                        <li class="active-menu"><a href="dashboard.php"><i class="far fa-chart-bar"></i> Dashboard</a></li>
                        <!-- <li><a><i class="fas fa-user"></i>Users</a>
                            <ul>
                                <li>
                                    <a href="user.html">User</a>
                                </li>
                                <li>
                                    <a href="user-edit.html">User edit</a>
                                </li>
                                <li>
                                    <a href="new-user.html">New user</a>
                                </li>
                            </ul> -->
                        </li>

                        <li>
                            <a><i class="fas fa-hotel"></i></i>Trip Expense</a>
                            <ul>
                            <!-- <li><a href="budget.php">Budget </a></li> -->
                                <li><a href="custrip.php">Customize Trip Expense</a></li>
                                <li><a href="alltrip.php">All Trip </a></li>
                            </ul>
                        </li>
                        <li>
                            <a><i class="fas fa-hotel"></i></i>Expense Manage</a>
                            <ul>

                                <li><a href="addexp.php">Add Expense</a></li>
                                <li><a href="allexp.php">All Expenses</a></li>
                                <!-- <li><a href="db-package-pending.html">Pending</a></li>
                                <li><a href="db-package-expired.html">Expired</a></li> -->
                            </ul>
                        </li>
                        <li>
                            <a><i class="fas fa-hotel"></i></i>Expense Report</a>
                            <ul>
                                <li><a href="todayexp.php">Today Expense</a></li>


                            </ul>
                        </li>
                        <!-- <li><a href="db-booking.html"><i class="fas fa-ticket-alt"></i></a></li> -->

                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
