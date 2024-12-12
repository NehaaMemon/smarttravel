<?php
include 'header.php';


if (isset($_POST['package'])) {

    // Fetch package inputs from the form and sanitize them
    $n = mysqli_real_escape_string($con, $_POST['name']);
    $des = mysqli_real_escape_string($con, $_POST['desc']);


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
    $stmt = $con->prepare("INSERT INTO `upcome`(`desti`, `des`,`img`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $n, $des,  $img_folder);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Package added successfully!')</script>";
        echo "<script>window.open('allpackages.php','_self')</script>";

    } else {
        echo "<script>alert(' Error adding package: ' . $stmt->error . )</script>";
    }

    // Close the statement
    $stmt->close();
}
?>
<br><br>
<div class="row gy-4">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <br><br><br><br>
                <h3 class="card-title mb-0">Add Upcoming Packages</h3>
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
                            <label class="form-label">Upload Image</label>
                            <input type="file" name="img" class="form-control" required>
                        </div>
                        <br>
                        <div class="col-12">
                            <button type="submit" name="package" class="button-primary">Submit</button>
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
