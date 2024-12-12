<?php
include 'header.php';





// Fetch all packages from the database
$query = "SELECT * FROM `upcome`";
$result = mysqli_query($con, $query);
?>
<style>
.bb{
    color: white !important;
}

</style>

<div class="db-info-wrap db-package-wrap">
    <div class="dashboard-box table-opp-color-box">
        <h4>Upcoming Packages List</h4>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Destination</th>
                        <th>Description</th>

                        <th>Image</th>
                        <th>Action</th>
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
                    <td><?php echo $row['desti']; ?></td>
                    <td><?php echo $row['des']; ?></td>

                    <td><img src="<?php echo $row['img']; ?>" alt="Image" style="width: 100px; height: auto;"></td>
                    <td><a  href="deletepac.php?id=<?php echo $row['id']; ?>" class='btn btn-danger bb' > Delete</a></td>
                </tr>
                <?php
                    } // End while loop
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No packages found.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


</div>

<?php
include 'footer.php'; // Include footer file
?>
