<?php
include 'header.php';


// Handle form submission for adding a new package
if (isset($_POST['addpackage'])) {

    // Fetch package inputs from the form and sanitize them
    $n = mysqli_real_escape_string($con, $_POST['name']);
    $des = mysqli_real_escape_string($con, $_POST['desc']);
    $wp = mysqli_real_escape_string($con, $_POST['wp']);
    $np = mysqli_real_escape_string($con, $_POST['np']);
    $dis = mysqli_real_escape_string($con, $_POST['dis']);

    // Handle the image file upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $img_name = $_FILES['img']['name'];
        $img_tmp_name = $_FILES['img']['tmp_name'];
        $img_folder = 'uploads/' . basename($img_name);

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($img_tmp_name, $img_folder)) {
            // Image uploaded successfully
        } else {
            echo "<p class='alert alert-danger'>Error uploading image.</p>";
            exit; // Stop execution if image upload fails
        }
    } else {
        echo "<p class='alert alert-danger'>Image upload error: " . $_FILES['img']['error'] . "</p>";
        exit;
    }

    // Use a prepared statement to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO `travel_packages`(`destination`, `description`, `original_price`, `discounted_price`, `discount`, `image_path`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddds", $n, $des, $wp, $np, $dis, $img_folder);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<p class='alert alert-success'>Package added successfully!</p>";
    } else {
        echo "<p class='alert alert-danger'>Error adding package: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}

// Fetch all packages from the database
$query = "SELECT * FROM travel_packages";
$result = mysqli_query($con, $query);
?>

<div class="db-info-wrap db-package-wrap">
    <div class="dashboard-box table-opp-color-box">
        <h4>Packages List</h4>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Destination</th>
                        <th>Description</th>
                        <th>Original Price</th>
                        <th>Discounted Price</th>
                        <th>Discount %</th>
                        <th>Image</th>
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
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>$<?php echo number_format($row['original_price'], 2); ?></td>
                    <td>$<?php echo number_format($row['discounted_price'], 2); ?></td>
                    <td><?php echo $row['discount']; ?>%</td>
                    <td><img src="<?php echo $row['image_path']; ?>" alt="Image" style="width: 100px; height: auto;"></td>
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
