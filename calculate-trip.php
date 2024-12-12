<?php
include 'header.php';





if (isset($_SESSION['id'])) {







?>
?>
<style>
 .link{
        color: White !important;
    }
</style>

<main id="content" class="site-main">
            <!-- Inner Banner html start-->
            <section class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(assets/images/inner-banner.jpg);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="inner-title">Trip Calculator</h1>
                     </div>
                  </div>
               </div>
               <div class="inner-shape"></div>
            </section>
            <!-- Inner Banner html end-->
            <!-- service html start -->
            <div class="service-page-section">
               <div class="container">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="service-content-wrap">
                           <div class="service-content">
                              <div class="service-header">
                                 <span class="service-count">
                                    01.
                                 </span>
                                 <h3>Prediction</h3>
                              </div>
                              <p>Easily estimate your total expenses based on your preferences and budget. Get a clear picture of your financial commitment before making a decision.</p>
                           </div>
                           <figure class="service-img">
                            <center> <img src="assets/images/img19.jpg" alt="">

                           </center>
                           </figure>
                           <br>
                          <center><button type="button"  class="button-primary"><a href="custom.php"  class="link" >Predict Your Amount</a></button></center>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="service-content-wrap">
                           <div class="service-content">
                              <div class="service-header">
                                 <span class="service-count">
                                    02.
                                 </span>
                                 <h3>Custom Plan</h3>
                              </div>
                              <p>Tailor your plan to suit your unique needs. Choose from a variety of options to create a personalized package that fits your lifestyle and budget.</p>
                           </div>
                           <figure class="service-img">
                            <center> <img src="assets/images/img18.jpg" alt="">

                        </center>
                           </figure>
                           <br>
                           <center><button type="button"  class="button-primary"><a href="user/custrip.php" class="link" >Plan Your Custom Trip</a></button></center>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
            <!-- service html end -->
            <!-- callback section html start -->
            <div class="fullwidth-callback" style="background-image: url(assets/images/img26.jpg);">
               <div class="container">
                  <div class="section-heading section-heading-white text-center">
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <h5 class="dash-style">CALLBACK FOR MORE</h5>
                           <h2>GO TRAVEL.DISCOVER. REMEMBER US!!</h2>
                           <p>Mollit voluptatem perspiciatis convallis elementum corporis quo veritatis aliquid blandit, blandit torquent, odit placeat. Adipiscing repudiandae eius cursus? Nostrum magnis maxime curae placeat.</p>
                        </div>
                     </div>
                  </div>
                  <div class="callback-counter-wrap">
                     <div class="counter-item">
                        <div class="counter-item-inner">
                           <div class="counter-icon">
                             <img src="assets/images/icon1.png" alt="">
                           </div>
                           <div class="counter-content">
                              <span class="counter-no">
                                 <span class="counter">500</span>K+
                              </span>
                              <span class="counter-text">
                                 Satisfied Clients
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="counter-item">
                        <div class="counter-item-inner">
                           <div class="counter-icon">
                             <img src="assets/images/icon2.png" alt="">
                           </div>
                           <div class="counter-content">
                              <span class="counter-no">
                                 <span class="counter">250</span>K+
                              </span>
                              <span class="counter-text">
                                 Awards Achieve
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="counter-item">
                        <div class="counter-item-inner">
                           <div class="counter-icon">
                             <img src="assets/images/icon3.png" alt="">
                           </div>
                           <div class="counter-content">
                              <span class="counter-no">
                                 <span class="counter">15</span>K+
                              </span>
                              <span class="counter-text">
                                 Active Members
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="counter-item">
                        <div class="counter-item-inner">
                           <div class="counter-icon">
                             <img src="assets/images/icon4.png" alt="">
                           </div>
                           <div class="counter-content">
                              <span class="counter-no">
                                 <span class="counter">10</span>K+
                              </span>
                              <span class="counter-text">
                                 Tour Destination
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- callback html end -->
         </main>

         <?php
         include 'footer.php';}
         else {
            echo "<script>window.open('user/login.php','_self');</script>";
        }
         ?>
