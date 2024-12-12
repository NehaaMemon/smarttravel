<?php
include 'header.php';


if (isset($_POST['addpackage'])) {

    // Fetch package inputs from the form and sanitize them
    $n = mysqli_real_escape_string($con, $_POST['name']);
    $des = mysqli_real_escape_string($con, $_POST['desc']);
    $wp = mysqli_real_escape_string($con, $_POST['wp']);
    $np = mysqli_real_escape_string($con, $_POST['np']);
    $dis = mysqli_real_escape_string($con, $_POST['dis']);

    // Handle image upload
    $img_folder = ''; // Initialize the image path variable

    if (!empty($_FILES['img']['name'])) {
        $img_name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $img_folder = "assets/img/" . basename($img_name); // Define the upload folder

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($tmp_name, $img_folder)) {
            echo "<p class='alert alert-success'>Image uploaded successfully.</p>";
        } else {
            echo "<p class='alert alert-danger'>Error uploading image.</p>";
            exit; // Stop execution if image upload fails
        }
    } else {
        echo "<p class='alert alert-danger'>No image uploaded.</p>";
        exit; // Exit if no image is uploaded
    }

    // Use a prepared statement to insert package data, including image path
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
?>

<div class="row gy-4">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <br><br><br><br>
                <h3 class="card-title mb-0">Add Offer Packages</h3>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row gy-3">

                        <div class="col-12">
                            <label class="form-label">Destination</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <input type="text" name="desc" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Original Price</label>
                            <input type="number" name="wp" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Discount Price</label>
                            <input type="number" name="np" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Discount %</label>
                            <input type="number" name="dis" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Upload Image</label>
                            <input type="file" name="img" class="form-control" required>
                        </div>
                        <br>
                        <div class="col-12">
                            <button type="submit" name="addpackage" class="button-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
