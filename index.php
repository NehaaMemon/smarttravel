<?php
error_reporting(0);
include 'header.php';

// echo $e;
$q2="SELECT * FROM `register` WHERE `email` = '$e'";
$run = mysqli_query($con, $q2);
$data = mysqli_fetch_assoc($run);
$_SESSION['id'] = $data['id'];
 $_SESSION['name'] = $data['name'];
$_SESSION['password'] = $data['password'];



echo'  <div class="popup-wraper">
        <div class="popup-inner">
           <div class="popup-content">
              <h2>Welcome  <br/>PLAN YOUR NEXT TRIP?</h2>


           </div>
           <div class="popup-image">
              <img src="assets/images/img52.png" alt="">
           </div>
           <div class="popup-close-btn">
              <a href="#"></a>
           </div>
        </div>
     </div>'
;
// Handle form submission for adding a new package
if (isset($_POST['addpackage'])) {
    // Fetch package inputs from the form
    $n = $_POST['name'];
    $des = $_POST['desc'];
    $wp = $_POST['wp'];
    $np = $_POST['np'];
    $dis = $_POST['dis'];

    // Handle the image file upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $img_name = basename($_FILES['img']['name']);
        $img_tmp_name = $_FILES['img']['tmp_name'];
        $img_folder = 'admin/uploads/' . $img_name;

        // Move the uploaded file to the desired directory
        if (!move_uploaded_file($img_tmp_name, $img_folder)) {
            echo "<p class='alert alert-danger'>Error uploading image.</p>";
            exit; // Stop execution if image upload fails
        }
    } else {
        echo "<p class='alert alert-danger'>Image upload error: " . $_FILES['img']['error'] . "</p>";
        exit;
    }

    // Use a prepared statement to insert the package data
    $stmt = $con->prepare("INSERT INTO `travel_packages`(`destination`, `description`, `original_price`, `discounted_price`, `discount`, `image_path`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddds", $n, $des, $wp, $np, $dis, $img_folder);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<p class='alert alert-success'>Package added successfully!</p>";
        header("Location: db-all-packages.php");
        exit();
    } else {
        echo "<p class='alert alert-danger'>Error adding package: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}

// Fetch all packages from the database
$query = "SELECT * FROM travel_packages LIMIT 3";
$result = mysqli_query($con, $query);

$q = "SELECT * FROM `upcome`";
$run = mysqli_query($con, $q);
$count = mysqli_num_rows($run);
?>

<style>
   .choice-slider-content a {
      margin-left: -133px;
   }
   .team {
      color: white !important;
   }
</style>

<main id="content" class="site-main">
    <section class="home-banner-section">
        <div class="home-banner-items">
            <div class="banner-inner-wrap" style="background-image: url(assets/images/slider-banner-2.jpg);"></div>
            <div class="banner-content-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="banner-content section-heading section-heading-white">
                                <h5>EXPLORE. DISCOVER. TRAVEL</h5>
                                <h2 class="banner-title">JOURNEY TO EXPLORE NATURE</h2>
                                <div class="title-icon-divider"><i class="fas fa-suitcase-rolling"></i></div>
                                <p>Taciti quasi, sagittis excepteur hymenaeos, id temporibus hic proident ullam, eaque donec delectus tempor consectetur nunc, purus congue? Rem volutpat sodales! Mollit. Minus exercitationem wisi.</p>
                                <div class="slider-button">
                                    <a href="offer.php" class="button-secondary">SEE ALL OFFER</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                </div>
            </div>
            <div class="overlay"></div>
        </div>
    </section>

    <section class="destination-section">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Package Offer</h2>
                <div class="title-icon-divider"><i class="fas fa-suitcase-rolling"></i></div>
            </div>
            <div class="special-section">
                <div class="row">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="special-item">
                            <figure class="special-img">
                                <img src="<?php echo 'admin/' . $row['image_path']; ?>" alt="Package Image">
                            </figure>
                            <div class="badge-dis">
                                <span><strong><?php echo $row['discount']; ?>%</strong> off</span>
                            </div>
                            <div class="special-content">
                                <div class="meta-cat">
                                    <a href="#"><?php echo $row['destination']; ?></a>
                                </div>
                                <h3><a href="#"><?php echo $row['description']; ?></a></h3>
                                <div class="package-price">
                                    Price:
                                    <del>$<?php echo number_format($row['original_price'], 2); ?></del>
                                    <ins>$<?php echo number_format($row['discounted_price'], 2); ?></ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo "<p>No packages available.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>
            <!-- <section class="home-about-section">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-7">
                        <div class="about-img-wrap">
                           <div class="about-img-left">
                              <div class="about-content secondary-bg d-flex flex-wrap">
                                 <h3>Something you want to know about us !!</h3>
                                 <a href="#" class="button-primary">LEARN MORE</a>
                              </div>
                              <div class="about-img">
                                 <img src="assets/images/img9.jpg" alt="">
                              </div>
                           </div>
                           <div class="about-img-right">
                              <div class="about-img">
                                 <img src="assets/images/img12.jpg" alt="">
                              </div>
                              <div class="about-img">
                                 <img src="assets/images/img34.jpg" alt="">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-5">
                        <div class="banner-content section-heading">
                           <h5>INTRODUCTION ABOUT US</h5>
                           <h2 class="banner-title">ULTIMATE GUIDE TO EPIC ADVENTURE</h2>
                           <div class="title-icon-divider"><i class="fas fa-suitcase-rolling"></i></div>
                           <p>Aperiam sociosqu urna praesent, tristique, corrupti condimentum asperiores platea ipsum ad arcu. Nostrud. Esse? Aut nostrum, ornare quas provident laoreet nesciunt odio voluptates etiam, omnis.</p>
                        </div>
                        <div class="about-service-container">
                           <div class="about-service">
                              <div class="about-service-icon">
                                 <img src="assets/images/icon15.png" alt="">
                              </div>
                              <div class="about-service-content">
                                 <h4>BEST PRICE GUARANTEED</h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec.</p>
                              </div>
                           </div>
                           <div class="about-service">
                              <div class="about-service-icon">
                                 <img src="assets/images/icon16.png" alt="">
                              </div>
                              <div class="about-service-content">
                                 <h4>AMAZING DESTINATION</h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec.</p>
                              </div>
                           </div>
                           <div class="about-service">
                              <div class="about-service-icon">
                                 <img src="assets/images/icon17.png" alt="">
                              </div>
                              <div class="about-service-content">
                                 <h4>PERSONAL SERVICES</h4>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec.</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section> -->
            <!-- client section html start -->
            <section class="activity-section activity-bg-image" style="background-image: url(assets/images/img29.jpg);">
               <div class="container">
                  <div class="section-heading section-heading-white text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5>EXPLORE GREAT PLACES</h5>
                           <h2>POPULAR PACKAGES</h2>
                           <div class="title-icon-divider"><i class="fas fa-suitcase-rolling"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="activity-inner row">
                     <div class="col-lg-2 col-md-4 col-6">
                        <div class="activity-item">
                           <div class="activity-icon">
                              <a href="#">
                                 <img src="assets/images/img44.png" alt="">
                              </a>
                           </div>
                           <div class="activity-content">
                              <h4>
                                 <a href="#">Adventure</a>
                              </h4>
                              <p>15 Destination</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-2 col-md-4 col-6">
                        <div class="activity-item">
                           <div class="activity-icon">
                              <a href="#">
                                 <img src="assets/images/img45.png" alt="">
                              </a>
                           </div>
                           <div class="activity-content">
                              <h4>
                                 <a href="#">Trekking</a>
                              </h4>
                              <p>12 Destination</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-2 col-md-4 col-6">
                        <div class="activity-item">
                           <div class="activity-icon">
                              <a href="#">
                                 <img src="assets/images/img46.png" alt="">
                              </a>
                           </div>
                           <div class="activity-content">
                              <h4>
                                 <a href="#">Camp Fire</a>
                              </h4>
                              <p>7 Destination</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-2 col-md-4 col-6">
                        <div class="activity-item">
                           <div class="activity-icon">
                              <a href="#">
                                 <img src="assets/images/img47.png" alt="">
                              </a>
                           </div>
                           <div class="activity-content">
                              <h4>
                                 <a href="#">Off Road</a>
                              </h4>
                              <p>15 Destination</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-2 col-md-4 col-6">
                        <div class="activity-item">
                           <div class="activity-icon">
                              <a href="#">
                                 <img src="assets/images/img48.png" alt="">
                              </a>
                           </div>
                           <div class="activity-content">
                              <h4>
                                 <a href="#">Camping</a>
                              </h4>
                              <p>13 Destination</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-2 col-md-4 col-6">
                        <div class="activity-item">
                           <div class="activity-icon">
                              <a href="#">
                                 <img src="assets/images/img49.png" alt="">
                              </a>
                           </div>
                           <div class="activity-content">
                              <h4>
                                 <a href="#">Exploring</a>
                              </h4>
                              <p>25 Destination</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>


            <!-- <div class="client-section">
               <div class="container">
                  <div class="client-wrap client-slider">
                     <div class="client-item">
                        <figure>
                           <img src="assets/images/logo7.png" alt="">
                        </figure>
                     </div>
                     <div class="client-item">
                        <figure>
                           <img src="assets/images/logo8.png" alt="">
                        </figure>
                     </div>
                     <div class="client-item">
                        <figure>
                           <img src="assets/images/logo9.png" alt="">
                        </figure>
                     </div>
                     <div class="client-item">
                        <figure>
                           <img src="assets/images/logo10.png" alt="">
                        </figure>
                     </div>
                     <div class="client-item">
                        <figure>
                           <img src="assets/images/logo11.png" alt="">
                        </figure>
                     </div>
                     <div class="client-item">
                        <figure>
                           <img src="assets/images/logo8.png" alt="">
                        </figure>
                     </div>
                  </div>
               </div>
            </div> -->
            <!-- client html end -->
            <!-- Home packages section html start -->
            <section class="package-section bg-light-grey">
               <div class="container">
                  <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5>EXPLORE GREAT PLACES</h5>
                           <h2>Upcoming PACKAGES</h2>
                           <div class="title-icon-divider"><i class="fas fa-suitcase-rolling"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="package-inner package-inner-list">
                     <div class="row">
                        <?php

        while ($data = mysqli_fetch_assoc($run)) {



        ?>
        <div class="col-md-6 col-lg-4">

                           <div class="package-wrap package-wrap-list">
                              <figure class="feature-image">
                                 <a href="#">
                                    <img src="admin/<?php echo $data['img']; ?>" alt="" height="280px">
                                 </a>

                                 <div class="package-meta text-center">
                                    <ul>


                                       <li>
                                          <i class="fas fa-map-marker-alt"></i>
                                          <?php echo $data['desti']; ?>
                                       </li>
                                    </ul>
                                 </div>
                              </figure>
                              <div class="package-content">


                                 <p><?php echo $data['des']; ?></p>

                              </div>

                           </div>
                        </div>

                        <?php }?>

                     </div>
                     <div class="btn-wrap text-center">
                        <!-- <a href="#" class="button-primary">VIEW ALL PACKAGES</a> -->
                     </div>
                  </div>
               </div>
            </section>
            <!-- packages html end -->
            <!-- Home activity section html start -->

            <!-- activity html end -->
            <!-- Home choice section html start -->
            <section class="choice-section">
               <div class="container">
                  <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5>JOURNEY IS FUN</h5>
                           <h2>TRAVELLER'S BEST CHOICE</h2>
                           <div class="title-icon-divider"><i class="fas fa-suitcase-rolling"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="choice-slider">
                     <div class="choice-slider-item" style="background-image: url(assets/images/img28.jpg);">
                       <div class="row">
                          <div class="col-lg-6 offset-lg-3">
                              <div class="choice-slider-content text-center">
                                 <h3>Holiday to the Oxolotan River</h3>
                                 <p>Maiores ab tempora deserunt quidem augue repellendus eleifend? Elementum sapien eu dis, rutrum augue nesciunt dolore viverra nec aspernatur proident eius porttitor faucibus netus? Maiores.</p>
                                 <a href="calculate-trip.php" class="button-primary">View More</a>
                              </div>
                          </div>
                       </div>
                     </div>
                     <div class="choice-slider-item" style="background-image: url(assets/images/img29.jpg);">
                       <div class="row">
                          <div class="col-lg-6 offset-lg-3">
                              <div class="choice-slider-content text-center">
                                 <h3>Couple vacation to Malaysia</h3>
                                 <p>Maiores ab tempora deserunt quidem augue repellendus eleifend? Elementum sapien eu dis, rutrum augue nesciunt dolore viverra nec aspernatur proident eius porttitor faucibus netus? Maiores.</p>
                                 <a href="calculate-trip.php" class="button-primary">View More</a>
                              </div>
                          </div>
                       </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- choice html end -->
            <!-- Home special section html start -->
            <!-- <section class="special-section">
               <div class="container">
                  <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5>TRAVEL OFFER & DISCOUNT</h5>
                           <h2>SPECIAL TRAVEL OFFER</h2>
                           <div class="title-icon-divider"><i class="fas fa-suitcase-rolling"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="special-inner mt-0">
                     <div class="row">
                        <div class="col-sm-6 col-lg-4">
                           <div class="special-overlay-inner">
                              <div class="special-overlay-item">
                                 <figure class="special-img">
                                    <img src="assets/images/img11.jpg" alt="">
                                    <div class="badge-dis">
                                       <span>
                                          <strong>15%</strong>
                                          off
                                       </span>
                                    </div>
                                 </figure>
                                 <div class="special-content">
                                    <div class="meta-cat">
                                       <a href="#">MALAYSIA</a>
                                    </div>
                                    <h3>
                                       <a href="#">Sunset view of beautiful lakeside city</a>
                                    </h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                           <div class="special-overlay-inner">
                              <div class="special-overlay-item">
                                 <figure class="special-img">
                                    <img src="assets/images/img10.jpg" alt="">
                                    <div class="badge-dis">
                                       <span>
                                          <strong>15%</strong>
                                          off
                                       </span>
                                    </div>
                                 </figure>
                                 <div class="special-content">
                                    <div class="meta-cat">
                                       <a href="#">NEW ZEALAND</a>
                                    </div>
                                    <h3>
                                       <a href="#">Trekking to the mountain camp site</a>
                                    </h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                           <div class="special-overlay-inner">
                              <div class="special-overlay-item">
                                 <figure class="special-img">
                                    <img src="assets/images/img9.jpg" alt="">
                                    <div class="badge-dis">
                                       <span>
                                          <strong>15%</strong>
                                          off
                                       </span>
                                    </div>
                                 </figure>
                                 <div class="special-content">
                                    <div class="meta-cat">
                                       <a href="#">CANADA</a>
                                    </div>
                                    <h3>
                                       <a href="#">Experience the natural beauty of glacier</a>
                                    </h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section> -->
            <!-- best html end -->
            <!-- Home subscribe section html start -->
            <section class="subscribe-section subscribe-bg-image" style="background-image: url(assets/images/img16.jpg);">
               <div class="container">
                  <div class="row">

                  <div class="container">
                  <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5 class="team">TEAM MEMBERS</h5>
                           <h2 class="team">OUR TOUR GUIDE</h2>
                           <div class="title-icon-divider"><i class="fas fa-suitcase-rolling team"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3 col-sm-6">
                        <div class="team-item">
                           <figure class="team-image">
                              <img src="assets/images/img38.jpg" alt="">
                           </figure>
                           <div class="team-content">
                              <div class="heading-wrap">
                                 <h3>Sony Madison</h3>
                                 <h5>Travel Agent</h5>
                              </div>
                              <div class="social-links">
                                 <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-6">
                        <div class="team-item">
                           <figure class="team-image">
                              <img src="assets/images/img42.jpg" alt="">
                           </figure>
                           <div class="team-content">
                              <div class="heading-wrap">
                                 <h3>Alison White</h3>
                                 <h5>Travel Guide</h5>
                              </div>
                              <div class="social-links">
                                 <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-6">
                        <div class="team-item">
                           <figure class="team-image">
                              <img src="assets/images/img43.jpg" alt="">
                           </figure>
                           <div class="team-content">
                              <div class="heading-wrap">
                                 <h3>William Hobb</h3>
                                 <h5>Travel Guide</h5>
                              </div>
                              <div class="social-links">
                                 <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-6">
                        <div class="team-item">
                           <figure class="team-image">
                              <img src="assets/images/img39.jpg" alt="">
                           </figure>
                           <div class="team-content">
                              <div class="heading-wrap">
                                 <h3>Jennie Bennett</h3>
                                 <h5>Travel Guide</h5>
                              </div>
                              <div class="social-links">
                                 <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
                     <!-- <div class="col-lg-7">
                        <div class="section-heading section-heading-white pr-40">
                           <h5>TRAVEL OFFER & DISCOUNT</h5>
                           <h2>HOLIDAY SPECIAL 25% OFF !</h2>
                           <div class="title-icon-divider"><i class="fas fa-suitcase-rolling"></i></div>
                           <h4>Sign up now to recieve hot special offers and information about the best tour packages, updates and discounts !!</h4>
                           <div class="newsletter-form">
                              <form>
                                 <input type="email" name="s" placeholder="Your Email Address">
                                 <input type="submit" name="signup" value="SIGN UP NOW!">
                              </form>
                           </div>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Eaque adipiscing, luctus eleifend temporibus occaecat luctus eleifend tempo ribus.</p>
                        </div>
                     </div>
                     <div class="col-lg-5">
                        <div class="progress-wrap">
                           <div class="progress-inner">
                              <div class="progress-circle" data-percentage="80">
                                 <span class="circle-left">
                                    <span class="circle-bar"></span>
                                 </span>
                                 <span class="circle-right">
                                    <span class="circle-bar"></span>
                                 </span>
                                 <div class="progress-value">
                                    85%
                                 </div>
                              </div>
                              <h4>Satisfied clients</h4>
                           </div>
                           <div class="progress-inner">
                              <div class="progress-circle" data-percentage="70">
                                 <span class="circle-left">
                                    <span class="circle-bar"></span>
                                 </span>
                                 <span class="circle-right">
                                    <span class="circle-bar"></span>
                                 </span>
                                 <div class="progress-value">
                                    75%
                                 </div>
                              </div>
                              <h4>Reasonable price</h4>
                           </div>
                           <div class="progress-inner">
                              <div class="progress-circle" data-percentage="70">
                                 <span class="circle-left">
                                    <span class="circle-bar"></span>
                                 </span>
                                 <span class="circle-right">
                                    <span class="circle-bar"></span>
                                 </span>
                                 <div class="progress-value">
                                    70%
                                 </div>
                              </div>
                              <h4>Best destination</h4>
                           </div>
                           <div class="progress-inner">
                              <div class="progress-circle" data-percentage="90">
                                 <span class="circle-left">
                                    <span class="circle-bar"></span>
                                 </span>
                                 <span class="circle-right">
                                    <span class="circle-bar"></span>
                                 </span>
                                 <div class="progress-value">
                                    90%
                                 </div>
                              </div>
                              <h4>Positive reviews</h4>
                           </div>
                        </div> -->
                     </div>
                  </div>
               </div>
            </section>
            <!-- subscribe html end -->

            <!-- <section class="blog-section">
               <div class="container">
                  <div class="section-heading text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5>FROM OUR BLOG</h5>
                           <h2>OUR RECENT POSTS</h2>
                           <div class="title-icon-divider"><i class="fas fa-suitcase-rolling"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6 col-lg-4">
                        <article class="post">
                           <figure class="feature-image">
                              <a href="#">
                                 <img src="assets/images/img17.jpg" alt="">
                              </a>
                           </figure>
                           <div class="entry-content">
                              <h3>
                                 <a href="#">Life is a beautiful journey not a destination</a>
                              </h3>
                              <div class="entry-meta">
                                 <span class="byline">
                                    <a href="#">Demoteam</a>
                                 </span>
                                 <span class="posted-on">
                                    <a href="#">August 17, 2021</a>
                                 </span>
                                 <span class="comments-link">
                                    <a href="#">No Comments</a>
                                 </span>
                              </div>
                           </div>
                        </article>
                     </div>
                     <div class="col-md-6 col-lg-4">
                        <article class="post">
                           <figure class="feature-image">
                              <a href="#">
                                 <img src="assets/images/img18.jpg" alt="">
                              </a>
                           </figure>
                           <div class="entry-content">
                              <h3>
                                 <a href="#">Take only memories, leave only footprints</a>
                              </h3>
                              <div class="entry-meta">
                                 <span class="byline">
                                    <a href="#">Demoteam</a>
                                 </span>
                                 <span class="posted-on">
                                    <a href="#">August 17, 2021</a>
                                 </span>
                                 <span class="comments-link">
                                    <a href="#">No Comments</a>
                                 </span>
                              </div>
                           </div>
                        </article>
                     </div>
                     <div class="col-md-6 col-lg-4">
                        <article class="post">
                           <figure class="feature-image">
                              <a href="#">
                                 <img src="assets/images/img19.jpg" alt="">
                              </a>
                           </figure>
                           <div class="entry-content">
                              <h3>
                                 <a href="#">Journeys are best measured in new friends</a>
                              </h3>
                              <div class="entry-meta">
                                 <span class="byline">
                                    <a href="#">Demoteam</a>
                                 </span>
                                 <span class="posted-on">
                                    <a href="#">August 17, 2021</a>
                                 </span>
                                 <span class="comments-link">
                                    <a href="#">No Comments</a>
                                 </span>
                              </div>
                           </div>
                        </article>
                     </div>
                  </div>
               </div>
            </section> -->
            <!-- blog html end -->
            <!-- Home callback section html start -->
            <section class="bg-img-callback" style="background-image: url(assets/images/img26.jpg);">
               <div class="container">
                  <div class="row align-items-center justify-content-between">
                     <div class="col-lg-9 col-md-8">
                        <div class="callback-content">
                           <h2>JOIN US FOR MORE UPDATE !!</h2>
                           <p>Traveling, whether for business or leisure, often involves managing multiple expenses. These expenses can quickly accumulate, leading to the necessity for meticulous tracking to stay within budget. Many travelers, however, struggle with maintaining an organized record of their expenditures, leading to overspending, loss of receipts, and difficulty in reimbursement claims.</p>
                        </div>
                     </div>

                  </div>
               </div>
            </section>
            <!-- callback html end -->
         </main>
         <?php
include 'footer.php';
?>
