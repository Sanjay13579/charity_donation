<?php
// Include your database connection file
include 'connection.php';

// Fetch donation data from the database
$query = "SELECT amount FROM donation";
$result = mysqli_query($con, $query);

// Initialize variables
$totalDonations = 0;
$averageAmount = 0;
$maxAmount = 0;
$minAmount = PHP_INT_MAX;
$donationCount = mysqli_num_rows($result);

// Calculate analytics
while ($row = mysqli_fetch_assoc($result)) {
    $amount = $row['amount'];
    $totalDonations += $amount;
    $maxAmount = max($maxAmount, $amount);
    $minAmount = min($minAmount, $amount);
}

if ($donationCount > 0) {
    $averageAmount = $totalDonations / $donationCount;
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Analytics</title>
</head>
<body>
    <h1>Donation Analytics</h1>
    <p>Total Donations: <?php echo $donationCount; ?></p>
    <p>Total Amount Donated: <?php echo $totalDonations; ?></p>
    <p>Average Donation Amount: <?php echo $averageAmount; ?></p>
    <p>Maximum Donation Amount: <?php echo $maxAmount; ?></p>
    <p>Minimum Donation Amount: <?php echo $minAmount; ?></p>
</body>
</html>
