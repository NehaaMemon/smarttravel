<?php
include 'header-u.php';
$id = $_SESSION['id'];

$run = null; // Initialize the variable to avoid undefined variable error

if (isset($_POST['report'])) {
    $s = $_POST['strtdate']; // Correcting the field name to match the form
    $e = $_POST['enddate'];   // Correcting the field name to match the form
    $query = "SELECT * FROM `expense` WHERE `dateexpense` BETWEEN '$s' AND '$e' AND `uid` = '$id'";
    $run = mysqli_query($con, $query);
}
?>

<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4>Filter Expenses</h4>
                <form class="form-horizontal" method="POST"> <!-- Submitting to the same page -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input name="strtdate" class="form-control" type="date" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>End Date</label>
                                <input name="enddate" class="form-control" type="date" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="report" class="btn btn-primary" value="Get Report">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box table-opp-color-box">
                <h4>Your Expenses</h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date of Expense</th>
                                <th>Cost of Expense</th>
                                <th>Category</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Check if the query has results before trying to display them
                        if ($run && mysqli_num_rows($run) > 0) {
                            while ($data = mysqli_fetch_assoc($run)) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($data['dateexpense']); ?></td>
                                    <td><span class="list-name"><?php echo htmlspecialchars($data['cost_of_expense']); ?></span></td>
                                    <td><?php echo htmlspecialchars($data['category']); ?></td>
                                    <td><?php echo htmlspecialchars($data['notes']); ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4'>No expenses found for the selected date range.</td></tr>";
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
