<?php
include 'header.php';

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
        $img_name = $_FILES['img']['name'];
        $img_tmp_name = $_FILES['img']['tmp_name'];
        $img_folder = 'admin/uploads/' . basename($img_name); // Adjusted the path

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

    // Use a prepared statement to insert the package data
    $stmt = $con->prepare("INSERT INTO `travel_packages`(`destination`, `description`, `original_price`, `discounted_price`, `discount`, `image_path`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddds", $n, $des, $wp, $np, $dis, $img_folder);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<p class='alert alert-success'>Package added successfully!</p>";
        // Redirect to db-all-packages page
        header("Location: db-all-packages.php");
        exit();
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

<main id="content" class="site-main">
    <!-- Inner Banner html start-->
    <section class="inner-banner-wrap">
        <div class="inner-baner-container" style="background-image: url(assets/images/inner-banner.jpg);">
            <div class="container">
                <div class="inner-banner-content">
                    <h1 class="inner-title">Package Offer</h1>
                </div>
            </div>
        </div>
        <div class="inner-shape"></div>
    </section>
    <!-- Inner Banner html end-->

    <section class="package-offer-wrap">
        <!-- special section html start -->
        <div class="special-section">
            <div class="container">
                <div class="special-inner">
                    <div class="row">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="special-item">
                                        <figure class="special-img">
                                            <img src="<?php echo 'admin/' . $row['image_path']; ?>" alt="Package Image"> <!-- Adjusted the path here -->
                                        </figure>
                                        <div class="badge-dis">
                                            <span>
                                                <strong><?php echo $row['discount']; ?>%</strong> off
                                            </span>
                                        </div>
                                        <div class="special-content">
                                            <div class="meta-cat">
                                                <a href="#"><?php echo $row['destination']; ?></a>
                                            </div>
                                            <h3>
                                                <a href="#"><?php echo $row['description']; ?></a>
                                            </h3>
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
        </div>
    </section>
</main>

<?php
include 'footer.php';
?>
