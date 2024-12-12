<?php
include 'header-u.php';

$id = $_SESSION['id']; // Get the logged-in user ID

// Fetch the individual expenses for the logged-in user
$q1 = "SELECT * FROM `expense` WHERE `uid` = '$id'";
$run = mysqli_query($con, $q1);

// Fetch the total sum of all expenses for the logged-in user
$q3 = "SELECT SUM(cost_of_expense) AS total_expense FROM `expense` WHERE `uid` = '$id'";
$result3 = mysqli_query($con, $q3);
$data3 = mysqli_fetch_assoc($result3);

// If no expenses, set the total expense to 0
$totalBudget = $data3['total_expense'] ?? 0;
?>

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
                            echo "<tr><td colspan='4'>No expenses found for your account.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <!-- Displaying the total sum of expenses -->
                <div class="total-expense-summary">
                    <h5>Total Expense Amount: <?php echo htmlspecialchars($totalBudget); ?> PKR</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
