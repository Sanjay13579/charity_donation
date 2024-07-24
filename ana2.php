<?php
// Include your database connection file
include 'connection.php';

// Get the current date in UTC
$currentDate = new DateTime('now', new DateTimeZone('UTC'));
$currentDateString = $currentDate->format('Y-m-d');

// Fetch donation data for the current day from the database
$query = "SELECT SUM(amount) AS total_amount FROM donation WHERE DATE(date_added) = '$currentDateString'";
$result = mysqli_query($con, $query);

$totalAmount = 0;

if ($row = mysqli_fetch_assoc($result)) {
    $totalAmount = (int) $row['total_amount'];
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Amount');

            var dataArray = [
                ['<?php echo $currentDateString; ?>', <?php echo $totalAmount; ?>]
            ];

            var options = {
                title: 'Donation Amount on <?php echo $currentDateString; ?>',
                hAxis: {title: 'Date'},
                vAxis: {title: 'Donation Amount'},
                bars: 'vertical'
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(google.visualization.arrayToDataTable(dataArray), options);
        }
    </script>
</head>
<body>
    <h1>Donation Analytics</h1>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
    
    <script>
        // Refresh the page after 24 hours (86400000 milliseconds)
        setTimeout(function() {
            location.reload();
        }, 86400000);
    </script>
</body>
</html>
