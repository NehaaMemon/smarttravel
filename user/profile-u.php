
<?php
include 'header-u.php';


if (isset($_SESSION['email'])) {

    // $id = $_SESSION['member_id'];
    // $id = $_GET['id'];
    // $_SESSION['id'] = $i;
    // echo  $i ;
    $e = $_SESSION['email'];
   $q7 = "SELECT * FROM `register` WHERE `email` like '$e' ";
  //  print_r($q7);
  //  die();
  //

     $row = mysqli_query($con, $q7);
     $data = mysqli_fetch_assoc($row);

     $_SESSION['name'] = $data['name'];
     $_SESSION['email'] = $data['email'];

     $_SESSION['phone'] = $data['phone'];

     $_SESSION['password'] = $data['password'];






  }





  ?>
?>

<div class="db-info-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard-box user-form-wrap">
                            <h4> <?php echo $_SESSION['name']; ?> Profile </h4>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>First name</label>
                                            <p><?php echo $_SESSION['name']; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <p><?php echo $_SESSION['email']; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Profile Image</label>
                                            <img src="<?php echo $data['img'];?>" alt="" width="50px" height="50px">
                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <p><?php echo $_SESSION['password']; ?></p>
                                        </div>
                                    </div>






                                </div>
                             <a href="edit-u.php">   <button type="submit" class="button-primary">Edit Profile</button>
                             </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
include 'footer.php';
?>


