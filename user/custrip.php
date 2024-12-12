<?php
include 'header-u.php'; // Include your header

// Currency Conversion Rates
$conversionRates = [
    'PKR' => 10,      // Assuming PKR is the base currency
    'USD' => 0.0035, // Example conversion rates
    'EUR' => 0.0032,
    'GBP' => 0.0028
];

// Check if form is submitted
if (isset($_POST['custom'])) {
    $n = $_POST['name'];
    $b = $_POST['badget'];   // User's total budget
    $d = $_POST['days'];     // Number of days for the trip
    $tr = $_POST['transport']; // Transport type
    $transportCost = isset($_POST['transport_cost']) ? $_POST['transport_cost'] : 0; // Transport cost
    $deductTransport = $_POST['deduct_transport']; // Deduct transport cost or not

    $currency = $_POST['cncode']; // User's selected currency
    $userId = $_SESSION['id'];

    // If the user wants to deduct transport cost from budget
    if ($deductTransport == 'yes') {
        $b = $b - $transportCost; // Deduct transport cost from budget
    }

    // Convert remaining budget to the selected currency
    $remainingInSelectedCurrency = $b * $conversionRates[$currency];

    // Insert trip details into the database
    $q = "INSERT INTO `trip` ( `budget`, `tripname`, `currency`, `days`, `transport`, `transport_cost`, `uid`)
          VALUES ('$b', '$n', '$currency', '$d', '$tr',  '$transportCost','$userId')";

    $row = mysqli_query($con, $q);

    if (!$row) {
        echo "Insert Error: " . mysqli_error($con);
        exit();
    }

    if ($row == true) {
        // Update session budget with the remaining amount in the selected currency
        $_SESSION['budget'] = $remainingInSelectedCurrency;
        $_SESSION['currency'] = $currency;

        // Alert user and refresh the page
        echo "<script>alert('Success! Your Budget is Updated. Remaining Balance in $currency: " . round($remainingInSelectedCurrency, 2) . "');</script>";
        echo "<script>window.open('addexp.php','_self')</script>";
    } else {
        echo '<script>alert("Error adding expense.")</script>';
    }
}
?>




<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-7">
            <div class="dashboard-box user-form-wrap">
                <center>
                    <h4>Customise Trip Form</h4>
                </center>
                <form class="form-horizontal" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Your Budget</label>
                                <input name="badget" class="form-control" type="number" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Trip Name</label>
                                <input name="name" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>What Currency You Use?</label>
                                <select name="cncode" id="currencyCode" required>
                                    <option value="PKR">PKR (₨)</option>
                                    <option value="USD">USD ($)</option>
                                    <option value="EUR">Euro (€)</option>
                                    <option value="GBP">GBP (£)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>How many days of Trip?</label>
                                <input name="days" class="form-control" type="number" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>What Transport you will Prefer?</label>
                                <select name="transport" id="transportType" required onchange="showTransportCost()">
                                    <option value="Flight">Flight</option>
                                    <option value="Train">Train</option>
                                    <option value="Bus">Bus</option>
                                </select>
                            </div>
                        </div>

                        <!-- Transport Cost Field -->
                        <div class="col-sm-6" id="transportCostField" style="display: none;">
                            <div class="form-group">
                                <label>Transport Cost</label>
                                <input name="transport_cost" class="form-control" type="number" min="0" step="0.01">
                            </div>
                        </div>

                        <!-- Deduct Transport Cost from Budget -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Do you want to deduct transport cost from your budget?</label>
                                <input type="radio" name="deduct_transport" value="yes" required> Yes
                                <input type="radio" name="deduct_transport" value="no" required> No
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button-primary" name="custom">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showTransportCost() {
        var transportType = document.getElementById('transportType').value;
        if (transportType === 'Flight' || transportType === 'Train' || transportType === 'Bus') {
            document.getElementById('transportCostField').style.display = 'block';
        } else {
            document.getElementById('transportCostField').style.display = 'none';
        }
    }
</script>


<?php
include 'footer.php';
?>
