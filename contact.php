<?php
include 'header.php';

if (isset($_POST['submit'])) {
    // Fetch expense inputs from the form
    $n = $_POST['name'];
    $em = $_POST['email'];
    $com = $_POST['comment'];

    // Prepare and execute the query
    $q = "INSERT INTO `comments` (`name`, `email`, `comment`) VALUES ('$n', '$em', '$com')";

    // Check if the query executes successfully
    if (mysqli_query($con, $q)) {
        echo "<script>alert('Comment posted successfully!');</script>";
        echo "<script>window.open('index.php','_self')</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}
?>




<main id="content" class="site-main">
    <!-- Inner Banner html start-->
    <section class="inner-banner-wrap">
        <div class="inner-baner-container" style="background-image: url(assets/images/inner-banner.jpg);">
            <div class="container">
                <div class="inner-banner-content">
                    <h1 class="inner-title">Contact Us</h1>
                </div>
            </div>
        </div>
        <div class="inner-shape"></div>
    </section>
    <!-- Inner Banner html end-->
    <section class="activity-section activity-bg-image" style="background-image: url(assets/images/img29.jpg);">
    <div class="single-post-section">
        <div class="single-post-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-lg-8 primary right-sidebar">
                        <div class="comment-area">
                            <div class="comment-form-wrap">
                                <center><h2 class="comment-title">Contact Form</h2></center>
                                <form class="comment-form" method="POST">

                                    <p>
                                        <label>Name *</label>
                                        <input type="text" name="name" required>
                                    </p>
                                    <p>
                                        <label>Email *</label>
                                        <input type="email" name="email" required>
                                    </p>

                                    <p class="full-width">
                                        <label>Comment</label>
                                        <textarea name="comment" rows="9" required></textarea>
                                    </p>
                                    <p class="full-width">
                                        <input type="submit" name="submit" value="Post comment">
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
<style>
   .comment-form {
    background-color: #e3dbbe;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto; /* Center the form */
}
.comment-title{
   color:white !important;
}
.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus {
    border-color: #007bff;
    outline: none; /* Remove outline on focus */
}

input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

</style>
<?php
include 'footer.php';
?>
