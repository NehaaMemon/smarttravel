<?php
include 'header-u.php';
?>

<div class="db-info-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard-box user-form-wrap">
                            <h4>User Edit Details</h4>
<form class="form-horizontal" method="post" enctype="multipart/form-data"> <!-- enctype added for file upload -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>First name</label>
                <input name="name" class="form-control" type="text" value="<?php echo $_SESSION['name'];?>">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Email</label>
                <input name="email" class="form-control" type="email" value="<?php echo $_SESSION['email'];?>" disabled>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Password</label>
                <input name="password" id="input-password" class="form-control" type="password" value="<?php echo $_SESSION['password'];?>">
            </div>
        </div>

        <div class="col-12">
            <h4>Upload Profile Photo</h4>
        </div>
        <div class="col-sm-6">
            <div class="upload-input">
                <div class="form-group">
                    <span class="upload-btn">Upload an image</span>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="button-primary" name="update-u">Update Profile</button>
</form>
                        </div>
                    </div>
                </div>
</div>





<?php


if (isset($_POST['update-u'])) {
    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = "img/" . $image; // Define the upload folder

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($tmp_name, $image_folder)) {
            echo "Image uploaded successfully.";
        } else {
            echo "Image upload failed.";
        }
    } else {
        $image_folder = $_SESSION['img']; // Use the existing image if no new image is uploaded
    }

    // Fetch form values
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_SESSION['email']; // Fetch email from session, since it's disabled in the form

    // Update the profile in the database
    $q = "UPDATE `register` SET `name` = '$name', `password` = '$password', `img` = '$image_folder' WHERE `email` = '$email'";

    $run = mysqli_query($con, $q);

    // Check if the update was successful
    if ($run) {
        // Update session variables
        $_SESSION['name'] = $name;
        $_SESSION['password'] = $password;
        $_SESSION['img'] = $image_folder;

        echo "<script>alert('Profile updated successfully!');</script>";
        echo "<script>window.open('profile-u.php','_self');</script>";
    } else {
        echo "Update Error: " . mysqli_error($con);
    }
}
include 'footer.php';
?>

