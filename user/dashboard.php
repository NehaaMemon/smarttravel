<?php
include 'header-u.php';
 $id = $_SESSION['id'] ;

$q3 = "SELECT * FROM `trip` where `uid` ='$id'";
$row3 = mysqli_query($con, $q3);
$count3 = mysqli_num_rows($row3);



$q3 = "SELECT SUM(budget) AS total_budget FROM `trip` WHERE `uid` = '$id'";
$result3 = mysqli_query($con, $q3);
$data3 = mysqli_fetch_assoc($result3);

$totalBudget = $data3['total_budget'] ?? 0; // Use 0 if there are no trips or no budget

// Fetch the total sum of all expenses for the logged-in user
$q3 = "SELECT SUM(cost_of_expense) AS total_expense FROM `expense` WHERE `uid` = '$id'";
$result3 = mysqli_query($con, $q3);
$data3 = mysqli_fetch_assoc($result3);

// If no expenses, set the total expense to 0
$totalexpense = $data3['total_expense'] ?? 0;

?>

            <div class="db-info-wrap">
                <div class="row">
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-8">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-blue">
                                <i class="far fa-chart-bar"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Your Trip</h4>
                                <h5><?php echo  $count3; ?></h5>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-8">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-green">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Your Total budget</h4>
                                <h5><?php echo  $totalBudget; ?></h5>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-8">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-purple">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Today Expense</h4>
                                <h5><?php echo  $totalexpense; ?></h5>
                            </div>
                        </div>
                    </div>

                </div>

                <?php




// Fetch individual expenses for the logged-in user
$q1 = "SELECT * FROM `expense` WHERE `uid` = '$id'";
$run = mysqli_query($con, $q1);

// Fetch total sum of all expenses for the logged-in user
$q3 = "SELECT SUM(cost_of_expense) AS total_expense FROM `expense` WHERE `uid` = '$id'";
$result3 = mysqli_query($con, $q3);
$data3 = mysqli_fetch_assoc($result3);

// If no expenses, set the total expense to 0
$totalBudget = $data3['total_expense'] ?? 0;

// Fetch expenses grouped by category
$qCategory = "SELECT category, SUM(cost_of_expense) AS category_total
              FROM `expense` WHERE `uid` = '$id'
              GROUP BY category";
$categoryRun = mysqli_query($con, $qCategory);

// Fetch expenses grouped by trip (assuming you have a 'trip' table to join with 'expense')
$qTrip = "SELECT t.tripname, SUM(e.cost_of_expense) AS trip_total
          FROM `expense` e
          LEFT JOIN `trip` t ON e.trip_id = t.trip_id
          WHERE e.uid = '$id'
          GROUP BY t.tripname";
$tripRun = mysqli_query($con, $qTrip);
?>


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

<!-- Category Summary -->
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4>Summary by Category</h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Total Expense (PKR)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Check if the category query has results before displaying them
                        if ($categoryRun && mysqli_num_rows($categoryRun) > 0) {
                            while ($categoryData = mysqli_fetch_assoc($categoryRun)) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($categoryData['category']); ?></td>
                                    <td><?php echo htmlspecialchars($categoryData['category_total']); ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='2'>No categories found for your expenses.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Trip Summary -->
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4>Summary by Trip</h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Trip Name</th>
                                <th>Total Expense (PKR)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Check if the trip query has results before displaying them
                        if ($tripRun && mysqli_num_rows($tripRun) > 0) {
                            while ($tripData = mysqli_fetch_assoc($tripRun)) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($tripData['tripname'] ? $tripData['tripname'] : 'No Trip'); ?></td>
                                    <td><?php echo htmlspecialchars($tripData['trip_total']); ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='2'>No trips found for your expenses.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>






      <?php
        include 'footer.php';
      ?>
