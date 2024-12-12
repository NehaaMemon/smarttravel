<?php
include 'header-u.php';



if (isset($_POST['budget'])) {
    $id = $_SESSION['id'];
    $b = $_POST['bud'];
    $d = $_POST['date'];

    // Correct the query variable
    $q = "INSERT INTO `budget` (`budget`, `date`,`rid`) VALUES ('$b', '$d','$id')";
    $row = mysqli_query($con, $q);  // Change $q2 to $q

    if ($row == true) {
        $_SESSION['budget'] = $b;
        $_SESSION['id'] = $id;

        echo  $_SESSION['budget'];

        echo '<script>alert("Success! Your Badget Added.")</script>';
        echo "<script>window.open('addexp.php','_self')</script>";
    } else {
        echo 'Error adding budget.';
    }
}

?>

<div class="db-info-wrap">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-7">
                        <div class="dashboard-box user-form-wrap">
                          <center> <h4>Add Budget</h4></center>
                            <form class="form-horizontal" method="post">
                            <div class="row">

                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label>Budget</label>
                                            <input name="bud" class="form-control" type="number" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input name="date" class="form-control" type="date">
                                        </div>
                                    </div>
                                </div>

                                </div>
                                <button type="submit" class="button-primary" name="budget">Add Budget</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <br><br>  <br><br>  <br><br><br><br>  <br><br>  <br><br>

<?php
include 'footer.php';
?>

