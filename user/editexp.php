<?php
include 'header-u.php'; // Include your header
$id = $_SESSION['id']; // User ID from session

// Check if expense ID is set in the URL
if (isset($_GET['id'])) {
    $expense_id = $_GET['id'];
} else {
    echo "Expense ID is not set in the URL.";
    exit();
}

// Query to fetch the specific expense by user ID and expense ID
$q6 = "SELECT * FROM `expense` WHERE `uid` = '$id' AND `id` = '$expense_id'";
$run = mysqli_query($con, $q6);

// Check if the expense exists
if (mysqli_num_rows($run) > 0) {
    $data = mysqli_fetch_assoc($run); // Fetch the expense data
} else {
    echo "No expense found with this ID.";
    exit();
}
?>

<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4>Edit Your Expense</h4>
                <form class="form-horizontal" method="POST" > <!-- Submitting to update_expense.php -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Expense</label>
                                <input name="date" class="form-control" type="date" value="<?php echo $data['dateexpense']; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cost of Expense</label>
                                <input name="cost" class="form-control" type="number" value="<?php echo $data['cost_of_expense']; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Category</label>
                                <input name="category" class="form-control" value="<?php echo $data['category']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Notes</label>
                                <input name="notes" class="form-control" type="text" value="<?php echo $data['notes']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <br>
                    <!-- Pass the expense ID for updating -->
                    <input type="hidden" name="expense_id" value="<?php echo $expense_id; ?>">
                    <input type="submit" name="editexpense" class="btn-primary" value="Update Expense">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<?php


if (isset($_POST['editexpense'])) {
    $expense_id = $_POST['expense_id']; // Get the expense ID from the hidden input field
    $date = $_POST['date'];
    $cost = $_POST['cost'];
    $category = $_POST['category'];
    $notes = $_POST['notes'];

    // Update the expense in the database
    $q = "UPDATE `expense` SET `dateexpense` = '$date', `cost_of_expense` = '$cost', `category` = '$category', `notes` = '$notes' WHERE `id` = '$expense_id'";

    $run = mysqli_query($con, $q);

    // Check if the update was successful
    if ($run) {
        echo "<script>alert('Expense updated successfully!');</script>";
        echo "<script>window.open('addexp.php','_self');</script>"; // Redirect to the all expenses page
    } else {
        echo "Update Error: " . mysqli_error($con);
    }
}
?>
