<?php
include 'header-u.php';

$id = $_SESSION['id']; // Get the logged-in user ID

// Fetch the individual trips for the logged-in user
$q1 = "SELECT * FROM `trip` WHERE `uid` = '$id'";
$run = mysqli_query($con, $q1);

// Handle trip deletion
if (isset($_POST['delete_trip'])) {
    $trip_id = $_POST['trip_id'];
    $delete_query = "DELETE FROM `trip` WHERE `trip_id` = '$trip_id' AND `uid` = '$id'";
    $delete_result = mysqli_query($con, $delete_query);
    if ($delete_result) {
        echo "<script>alert('Trip deleted successfully.'); window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Error deleting trip: " . mysqli_error($con) . "');</script>";
    }
}

// Handle trip editing
if (isset($_POST['edit_trip'])) {
    $trip_id = $_POST['trip_id'];
    $tripname = $_POST['tripname'];
    $budget = $_POST['budget'];
    $currency = $_POST['currency'];
    $days = $_POST['days'];
    $transport = $_POST['transport'];
    $transport_cost = $_POST['transport_cost'];

    $update_query = "UPDATE `trip` SET `tripname` = '$tripname', `budget` = '$budget', `currency` = '$currency',
                    `days` = '$days', `transport` = '$transport', `transport_cost` = '$transport_cost'
                    WHERE `trip_id` = '$trip_id' AND `uid` = '$id'";
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        echo "<script>alert('Trip updated successfully.'); window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Error updating trip: " . mysqli_error($con) . "');</script>";
    }
}

?>

<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box table-opp-color-box">
                <h4>Your Trips Detail</h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Budget</th>
                                <th>Trip Name</th>
                                <th>Currency</th>
                                <th>Days</th>
                                <th>Transport</th>
                                <th>Transport Cost</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Check if the query has results before trying to display them
                        if ($run && mysqli_num_rows($run) > 0) {
                            while ($data = mysqli_fetch_assoc($run)) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($data['budget']); ?></td>
                                    <td><span class="list-name"><?php echo htmlspecialchars($data['tripname']); ?></span></td>
                                    <td><?php echo htmlspecialchars($data['currency']); ?></td>
                                    <td><?php echo htmlspecialchars($data['days']); ?></td>
                                    <td><?php echo htmlspecialchars($data['transport']); ?></td>
                                    <td><?php echo htmlspecialchars($data['transport_cost']); ?></td>
                                    <td>
                                        <!-- Edit Button: Shows an edit form in a modal -->
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal<?php echo $data['trip_id']; ?>">Edit</button>

                                        <!-- Delete Form -->
                                        <form method="POST" style="display:inline-block;">
                                            <input type="hidden" name="trip_id" value="<?php echo $data['trip_id']; ?>">
                                            <button type="submit" name="delete_trip" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this trip?');">Delete</button>
                                        </form>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal<?php echo $data['trip_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Trip</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="trip_id" value="<?php echo $data['trip_id']; ?>">
                                                            <div class="form-group">
                                                                <label>Trip Name</label>
                                                                <input type="text" name="tripname" class="form-control" value="<?php echo htmlspecialchars($data['tripname']); ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Budget</label>
                                                                <input type="number" name="budget" class="form-control" value="<?php echo htmlspecialchars($data['budget']); ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Currency</label>
                                                                <select name="currency" class="form-control" required>
                                                                    <option value="PKR" <?php echo ($data['currency'] == 'PKR') ? 'selected' : ''; ?>>PKR</option>
                                                                    <option value="USD" <?php echo ($data['currency'] == 'USD') ? 'selected' : ''; ?>>USD</option>
                                                                    <option value="EUR" <?php echo ($data['currency'] == 'EUR') ? 'selected' : ''; ?>>EUR</option>
                                                                    <!-- Add other currencies as needed -->
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Days</label>
                                                                <input type="number" name="days" class="form-control" value="<?php echo htmlspecialchars($data['days']); ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Transport</label>
                                                                <input type="text" name="transport" class="form-control" value="<?php echo htmlspecialchars($data['transport']); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Transport Cost</label>
                                                                <input type="number" name="transport_cost" class="form-control" value="<?php echo htmlspecialchars($data['transport_cost']); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="edit_trip" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>No trips found for your account.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
