<?php
include 'db.php'; // Include your database connection file

// Check if the `id` parameter is set in the URL
if (isset($_GET['id'])) {
    $expense_id = $_GET['id']; // Get the expense ID from the URL
    $user_id = $_SESSION['id']; // Make sure the user is logged in and we have the user ID from the session

    // Check if the expense belongs to the logged-in user
    $check_query = "SELECT * FROM `expense` WHERE `id` = '$expense_id' AND `uid` = '$user_id'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // If the expense exists and belongs to the user, proceed to delete it
        $delete_query = "DELETE FROM `expense` WHERE `id` = '$expense_id'";
        $delete_result = mysqli_query($con, $delete_query);

        if ($delete_result) {
            // Redirect to the all expenses page with a success message
            echo "<script>alert('Expense deleted successfully!');</script>";
            echo "<script>window.open('addexp.php','_self');</script>";
        } else {
            echo "Error deleting expense: " . mysqli_error($con);
        }
    } else {
        echo "You do not have permission to delete this expense.";
    }
} else {
    echo "No expense ID provided.";
}
?>
