<?php
include 'header.php';


// Handle form submission for adding a new package


// Fetch all packages from the database
$query = "SELECT * FROM comments";
$result = mysqli_query($con, $query);
?>

<div class="db-info-wrap db-package-wrap">
    <div class="dashboard-box table-opp-color-box">
        <h4>All User Comments </h4>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>

                        <th>Comments</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                // Check if packages exist in the database
                if (mysqli_num_rows($result) > 0) {

                    // Loop through each package and display it in a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>

                    <td><?php echo $row['comment']; ?></td>
                </tr>
                <?php
                    } // End while loop
                } else {
                    echo "Try Again";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<br><br><br>
<?php
include 'footer.php'; // Include footer file
?>
