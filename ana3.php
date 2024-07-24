<?php
// Include your database connection file
include 'connection.php';

// Fetch donation data from the database
$query = "SELECT date_added, amount FROM donation"; // Assuming there's a 'date_added' column in your 'donation' table
$result = mysqli_query($con, $query);

$dataArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $dateTime = new DateTime($row['date_added'], new DateTimeZone('UTC')); // Set to Kolkata time zone
    $dataPoint = array(
        "time" => $dateTime->format('Y-m-d H:i:s'), // Formatted date and time
        "amount" => (int) $row['amount']
    );
    $dataArray[] = $dataPoint;
}

// Close the database connection
mysqli_close($con);
?>

<!-- Your PHP code remains unchanged -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Analytics</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('datetime', 'Time');
            data.addColumn('number', 'Amount');

            var dataArray = <?php echo json_encode($dataArray); ?>;
            dataArray.forEach(function(dataPoint) {
                var date = new Date(dataPoint.time);
                data.addRow([date, dataPoint.amount]);
            });

            var options = {
                title: 'Donation Amount vs Donated Time',
                hAxis: {title: 'Time'},
                vAxis: {
                    title: 'Donation Amount',
                    minValue: 100,
                    maxValue: 10000
                },
                curveType: 'function' // Set the curveType to 'function'
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <h1>Donation Analytics</h1>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
</body>
</html>
