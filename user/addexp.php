<?php

include 'header-u.php';

// Database connection
// $con = mysqli_connect(...);

$userId = $_SESSION['id'];
$queryTrips = "SELECT * FROM `trip` WHERE `uid` = '$userId'";
$resultTrips = mysqli_query($con, $queryTrips);

if (!$resultTrips) {
    echo "Error fetching trips: " . mysqli_error($con);
    exit();
}

// Check if a trip is selected
if (isset($_POST['select_trip'])) {
    $selectedTripId = $_POST['trip_id'];

    // Fetch the budget and name for the selected trip
    $queryTripBudget = "SELECT * FROM `trip` WHERE `trip_id` = '$selectedTripId' AND `uid` = '$userId'";
    $resultTripBudget = mysqli_query($con, $queryTripBudget);
    $tripData = mysqli_fetch_assoc($resultTripBudget);

    if ($tripData) {
        if ($_SESSION['selected_trip_id'] !== $selectedTripId) {
            $_SESSION['selected_trip_id'] = $selectedTripId;
            $_SESSION['trip_name'] = $tripData['tripname'];
            $_SESSION['original_budget'] = $tripData['budget'];

            // Reset remaining budget to original budget on trip selection
            $_SESSION['remain'] = $_SESSION['original_budget'];
        }
    } else {
        echo '<script>alert("Error: Trip not found.");</script>';
    }
}

// Define a function to check if budget alert should be triggered
function check_budget_alert($remain, $original_budget) {
    $alert_threshold = 0.2 * $original_budget; // Trigger alert if remaining budget is less than 20% of the original budget

    if ($remain <= 0) {
        return 'You have exceeded your budget!';
    } elseif ($remain <= $alert_threshold) {
        return 'Warning: Your remaining budget is less than 20% of the total budget!';
    }
    return false; // No alert needed
}

// Add expense
if (isset($_POST['addexpense'])) {
    $d = $_POST['date'];
    $c = $_POST['cost'];
    $ca = $_POST['category'];
    $no = !empty($_POST['notes']) ? $_POST['notes'] : NULL;
    $tripId = $_SESSION['selected_trip_id'];

    $remain = $_SESSION['remain'] - $c;

    if ($remain >= 0) {
        $q = "INSERT INTO `expense` (`dateexpense`, `cost_of_expense`, `category`, `notes`, `remain_amount`, `uid`, `trip_id`)
              VALUES ('$d', '$c', '$ca', '$no', '$remain', '$userId', '$tripId')";
        $row = mysqli_query($con, $q);

        if ($row) {
            $_SESSION['remain'] = $remain;
            echo '<script>alert("Success! Your expense has been added and the budget is updated.");</script>';

            // Check for budget alerts
            $alert_message = check_budget_alert($remain, $_SESSION['original_budget']);
            if ($alert_message) {
                echo "<script>alert('$alert_message');</script>";
            }
        } else {
            echo "Insert Error: " . mysqli_error($con);
            exit();
        }
    } else {
        echo '<script>alert("Error: Remaining budget cannot be negative.");</script>';
    }
}

// Delete expense
if (isset($_POST['delete_expense'])) {
    $expenseId = $_POST['expense_id'];

    $expenseQuery = "SELECT * FROM `expense` WHERE `id` = '$expenseId'";
    $expenseResult = mysqli_query($con, $expenseQuery);
    $expenseData = mysqli_fetch_assoc($expenseResult);

    if ($expenseData) {
        $deletedCost = $expenseData['cost_of_expense'];
        $q = "DELETE FROM `expense` WHERE `id` = '$expenseId'";
        $row = mysqli_query($con, $q);

        if ($row) {
            $_SESSION['remain'] += $deletedCost;
            echo '<script>alert("Success! Your expense has been deleted and the budget is updated.");</script>';

            // Check for budget alerts
            $alert_message = check_budget_alert($_SESSION['remain'], $_SESSION['original_budget']);
            if ($alert_message) {
                echo "<script>alert('$alert_message');</script>";
            }
        } else {
            echo "Delete Error: " . mysqli_error($con);
            exit();
        }
    } else {
        echo '<script>alert("Error: Expense not found.");</script>';
    }
}
?>

<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4>Select Trip</h4>
                <form class="form-horizontal" method="POST">
                    <div class="form-group">
                        <label>Select Your Trip</label>
                        <select name="trip_id" class="form-control" required>
                            <option value="">-- Select Trip --</option>
                            <?php while ($trip = mysqli_fetch_assoc($resultTrips)) { ?>
                                <option value="<?php echo htmlspecialchars($trip['trip_id']); ?>">
                                    <?php echo htmlspecialchars($trip['tripname']) . ' (Budget: ' . htmlspecialchars($trip['budget']) . ')'; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="submit" name="select_trip" class="btn btn-primary" value="Select Trip">
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_SESSION['selected_trip_id'])) { ?>
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4>Add Expense</h4>
                <p class="selected-trip">Selected Trip: <?php echo htmlspecialchars($_SESSION['trip_name']); ?></p>
                <form class="form-horizontal" method="POST">
                    <p class="account">Your Remaining Budget is <?php echo htmlspecialchars($_SESSION['remain']) . ' ' . htmlspecialchars($_SESSION['currency']); ?>.</p>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Expense</label>
                                <input name="date" class="form-control" type="date" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cost of Expense</label>
                                <input name="cost" class="form-control" type="number" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control">
                                    <option>Food</option>
                                    <option>Transport</option>
                                    <option>Accommodation expenses</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Notes</label>
                                <input name="notes" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="addexpense" class="btn btn-primary" value="Add Expense">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4>Expenses for Trip ID: <?php echo htmlspecialchars($_SESSION['selected_trip_id']); ?></h4>
                <table class="table">
                    <tr><th>Date</th><th>Cost</th><th>Category</th><th>Notes</th><th>Actions</th></tr>
                    <?php
                    if (isset($_SESSION['selected_trip_id'])) {
                        $tripId = $_SESSION['selected_trip_id'];
                        $expensesQuery = "SELECT * FROM `expense` WHERE `trip_id` = '$tripId'";
                        $expensesResult = mysqli_query($con, $expensesQuery);

                        while ($expense = mysqli_fetch_assoc($expensesResult)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($expense['dateexpense']) . "</td>
                                    <td>" . htmlspecialchars($expense['cost_of_expense']) . "</td>
                                    <td>" . htmlspecialchars($expense['category']) . "</td>
                                    <td>" . htmlspecialchars($expense['notes']) . "</td>
                                    <td>
                                        <form method='POST' style='display:inline-block;'>
                                            <input type='hidden' name='expense_id' value='" . htmlspecialchars($expense['id']) . "'>
                                            <input type='submit' name='delete_expense' value='Delete' class='btn btn-danger'>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; } ?>
