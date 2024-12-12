<?php



include 'db.php';


if (isset($_SESSION['email'])) {
   $e= $_SESSION['email'];
   $q2="SELECT * FROM `register` WHERE `email` = '$e'";
   $run = mysqli_query($con, $q2);
   $data = mysqli_fetch_assoc($run);
   $_SESSION['id'] = $data['id'];
    $_SESSION['name'] = $data['name'];
   $_SESSION['password'] = $data['password'];

   echo "<style>.account{display: none !important;} .member1{display: block !important;}</style>";

  }
else{
    echo "<style>.account{display:block !important;} .member1{display:none!important;}</style>";
}



// }



?>




<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- favicon -->
      <link rel="icon" type="image/png" href="assets/images/favicon1.png">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" media="all">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="assets/vendors/fontawesome/css/all.min.css">
      <!-- jquery-ui css -->
      <link rel="stylesheet" type="text/css" href="assets/vendors/jquery-ui/jquery-ui.min.css">
      <!-- modal video css -->
      <link rel="stylesheet" type="text/css" href="assets/vendors/modal-video/modal-video.min.css">
      <!-- light box css -->
      <link rel="stylesheet" type="text/css" href="assets/vendors/lightbox/dist/css/lightbox.min.css">
      <!-- slick slider css -->
      <link rel="stylesheet" type="text/css" href="assets/vendors/slick/slick.css">
      <link rel="stylesheet" type="text/css" href="assets/vendors/slick/slick-theme.css">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="style.css">
      <title>ExpenseVoyage </title>
   </head>
   <body class="home">
      <div id="siteLoader" class="site-loader">
         <div class="preloader-content">
            <img src="assets/images/loader1.gif" alt="">
         </div>
      </div>
      <div id="page" class="full-page">
         <header id="masthead" class="site-header header-primary">
            <!-- header html start -->
            <div class="top-header">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-8 d-none d-lg-block">
                        <div class="header-contact-info">
                           <ul>
                              <li>
                                 <a href="#"><i class="fas fa-phone-alt"></i> +92 (333) 2599 12</a>
                              </li>
                              <li>
                                 <a href="mailto:info@Travel.com"><i class="fas fa-envelope"></i> expensevoyage@gmail.com</a>
                              </li>
                              <li>
                                 <i class="fas fa-map-marker-alt"></i> 3146 Saima tower , Karachi
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-lg-4 d-flex justify-content-lg-end justify-content-between">
                        <div class="header-social social-links">
                           <ul>
                              <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                              <li><a href="https://www.facebook.com/TwitterInc/"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                              <li><a href="https://www.instagram.com/accounts/login/?hl=en"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                              <li><a href="https://www.linkedin.com/login"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                           </ul>
                        </div>
                        <div class="header-search-icon">
                           <!-- <button class="search-icon">
                              <i class="fas fa-search"></i>
                           </button> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="bottom-header">
               <div class="container d-flex justify-content-between align-items-center">
                  <div class="site-identity">
                     <h1 class="site-title">
                        <a href="index.php">
                           <img class="white-logo" src="assets/images/2-removebg-preview.png" alt="logo">
                           <img class="black-logo" src="assets/images/2.png" alt="logo" width="100%">
                        </a>
                     </h1>
                  </div>
                  <div class="main-navigation d-none d-lg-block">
                     <nav id="navigation" class="navigation">
                        <ul>
                           <li class="menu-item">
                              <a href="index.php">Home</a>

                           </li>
                           <li class="menu-item">
                              <a href="offer.php">Tour </a>
                              <!-- <ul>
                                 <li>
                                    <a href="destination.html">Destination</a>
                                 </li> -->
                                 <!-- <li>
                                    <a href="tour-packages.html">Tour Packages</a>
                                 </li>
                                 <li>
                                    <a href="package-offer.html">Package Offer</a>
                                 </li>
                                 <li>
                                    <a href="package-detail.html">Package Detail</a>
                                 </li>
                                 <li>
                                    <a href="tour-cart.html">Tour Cart</a>
                                 </li>
                                 <li>
                                    <a href="booking.html">Package Booking</a>
                                 </li>
                                 <li>
                                    <a href="confirmation.html">Confirmation</a>
                                 </li> -->
                              <!-- </ul> -->
                           </li>
                           <!-- <li class="menu-item">
                              <a href="#">Pages</a>

                           </li> -->
                           <li class="menu-item ">
                           <a href="calculate-trip.php" >Trip Calculator</a>
                           <!-- <li class="menu-item-has-children">
                              <a href="single-page.html">Shop</a>
                              <ul>
                                 <li>
                                    <a href="product-right.html">Shop Archive</a>
                                 </li>
                                 <li>
                                    <a href="product-detail.html">Shop Single</a>
                                 </li>
                                 <li>
                                    <a href="product-cart.html">Shop Cart</a>
                                 </li>
                                 <li>
                                    <a href="product-checkout.html">Shop Checkout</a>
                                 </li>
                              </ul>
                           </li> -->
                           <!-- <li class="menu-item-has-children">
                              <a href="#">Blog</a>
                              <ul>
                                 <li><a href="blog-archive.html">Blog List</a></li>
                                 <li><a href="blog-archive-left.html">Blog Left Sidebar</a></li>
                                 <li><a href="blog-archive-both.html">Blog Both Sidebar</a></li>
                                 <li><a href="blog-single.html">Blog Single</a></li>
                              </ul>
                           </li> -->
                           <li class="menu-item">
                              <a href="user/dashboard.php?id=<?php echo $data['id']; ?>" class="member1">Dashboard</a>
                          <!-- <ul> -->
                                 <!-- <li>
                                    <a href="admin/dashboard.html">Dashboard</a>
                                 </li> -->
                                 <!-- <li class="menu-item-has-children">
                                    <a href="#">User</a>
                                    <ul>
                                       <li>
                                          <a href="admin/user.html">User List</a>
                                       </li>
                                       <li>
                                          <a href="admin/user-edit.html">User Edit</a>
                                       </li>
                                       <li>
                                          <a href="admin/new-user.html">New User</a>
                                       </li> -->
                                    <!-- </ul>
                                 </li>
                                 <li>
                                    <a href="admin/db-booking.html">Booking</a>
                                 </li>
                                 <li class="menu-item-has-children">
                                    <a href="admin/db-package.html">Package</a>
                                    <ul>
                                       <li>
                                          <a href="admin/db-package-active.html">Package Active</a>
                                       </li>
                                       <li>
                                          <a href="admin/db-package-pending.html">Package Pending</a>
                                       </li>
                                       <li>
                                          <a href="admin/db-package-expired.html">Package Expired</a>
                                       </li>
                                    </ul> -->
                                 <!-- </li>
                                 <li>
                                    <a href="admin/db-comment.html">Comments</a>
                                 </li>
                                 <li>
                                    <a href="admin/db-wishlist.html">Wishlist</a>
                                 </li> -->
                                 <!-- <li>
                                    <a href="admin/login.html">Login</a>
                                 </li> -->
                                 <!-- <li>
                                    <a href="admin/forgot.html">Forget Password</a>
                                 </li> -->
                              <!-- </ul> -->
                           </li>
                           <!-- <li class="menu-item-has-children">
                              <a href="login.php">Login</a>
                           </li> -->
                           <li class="menu-item">
                           <a href="about.php">About </a>
                           </li>
                           <li class="menu-item">
                           <a href="contact.php">Contact </a>
                           </li>
                        </ul>
                     </nav>
                  </div>
                  <div class="header-btn log">
                     <a href="user/login.php" class="button-primary account">Login</a>
                  </div>
                  <div class="header-btn">
                     <a href="user/register.php" class="button-primary account">Register</a>
                  </div>

                  <div class="header-btn">
                     <a href="logout.php" class="button-primary member1">Logout</a>
                  </div>
               </div>
            </div>
            <div class="mobile-menu-container"></div>
         </header>
<style>
    .header-btn a{
        margin-right: -29px;
}
</style>
<script src="assets/js/jquery.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
      <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/vendors/jquery-ui/jquery-ui.min.js"></script>
      <script src="assets/vendors/countdown-date-loop-counter/loopcounter.js"></script>
      <script src="assets/js/jquery.counterup.js"></script>
      <script src="assets/vendors/modal-video/jquery-modal-video.min.js"></script>
      <script src="assets/vendors/masonry/masonry.pkgd.min.js"></script>
      <script src="assets/vendors/lightbox/dist/js/lightbox.min.js"></script>
      <script src="assets/vendors/slick/slick.min.js"></script>
      <script src="assets/js/jquery.slicknav.js"></script>
      <script src="assets/js/custom.min.js"></script>
<script>
         $( document ).on( 'click', '.popup-close-btn a', function(e){
            e.preventDefault();
            $('.popup-wraper').hide();
         });
      </script>
