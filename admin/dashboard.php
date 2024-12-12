<?php
include 'header.php';


$q3 = "SELECT * FROM `travel_packages` ";
$row3 = mysqli_query($con, $q3);
$count3 = mysqli_num_rows($row3);


$q2 = "SELECT * FROM `trip` ";
$row = mysqli_query($con, $q2);
$count2 = mysqli_num_rows($row);



$q = "SELECT * FROM `comments` ";
$row = mysqli_query($con, $q);
$count1 = mysqli_num_rows($row);


?>
            <div class="db-info-wrap">
                <div class="row">
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-8">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-blue">
                                <i class="far fa-chart-bar"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Total Trips Packages</h4>
                                <h5><?php echo $count3 ;?></h5>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-8">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-green">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Total Comments</h4>
                                <h5><?php echo $count1 ;?></h5>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-8">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-purple">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Customise Trips</h4>
                                <h5><?php echo $count2 ;?></h5>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard-box">
                            <h4>User Comments</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>Name</th>

                                            <th>Email</th>
                                            <th>Coments</th>

                                    </thead>
                                    <tbody>

                                    <?php

                    while($data=mysqli_fetch_assoc($row)){


                    ?>
                                        <tr>


                                        <td><?php echo $data['name'];?></td>
                                            <td><?php echo $data['email'];?></td>
                                            <td>P<?php echo $data['comment'];?></td>

                                        </tr>

                                    <?php
                                         }
                                    ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
         <?php
include 'footer.php';

?>

